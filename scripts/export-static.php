<?php

declare(strict_types=1);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();
$app->instance('request', Request::create('/', 'GET'));

$repositoryUrl = 'https://ttarpsj.github.io/icahnmemorial';
$outputDirectory = __DIR__.'/../docs';
$publicDirectory = __DIR__.'/../public';

config(['app.url' => $repositoryUrl]);
URL::forceRootUrl($repositoryUrl);
URL::forceScheme('https');

function removeDirectory(string $directory): void
{
    if (! is_dir($directory)) {
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST,
    );

    foreach ($iterator as $file) {
        $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
    }

    rmdir($directory);
}

function copyDirectory(string $source, string $destination): void
{
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST,
    );

    foreach ($iterator as $file) {
        $target = $destination.DIRECTORY_SEPARATOR.$iterator->getSubPathName();
        if ($file->isDir()) {
            is_dir($target) || mkdir($target, 0777, true);
            continue;
        }

        is_dir(dirname($target)) || mkdir(dirname($target), 0777, true);
        copy($file->getPathname(), $target);
    }
}

function staticPath(string $route): string
{
    $route = trim($route, '/');
    return $route === '' ? 'index.html' : $route.'/index.html';
}

function staticUrl(string $route): string
{
    $route = trim($route, '/');
    return $route === ''
        ? 'https://ttarpsj.github.io/icahnmemorial/'
        : "https://ttarpsj.github.io/icahnmemorial/{$route}/";
}

function makeStaticLinks(string $html, array $routes): string
{
    $routes = array_filter($routes);
    usort($routes, static fn (string $left, string $right): int => strlen($right) <=> strlen($left));

    foreach ($routes as $route) {
        $withoutSlash = rtrim(staticUrl($route), '/');
        $html = preg_replace(
            '~'.preg_quote($withoutSlash, '~').'(?=["\'#?])~',
            staticUrl($route),
            $html,
        );
    }

    return preg_replace(
        '~'.preg_quote(rtrim(staticUrl(''), '/'), '~').'(?=["\'#?])~',
        staticUrl(''),
        $html,
    );
}

removeDirectory($outputDirectory);
mkdir($outputDirectory, 0777, true);
copyDirectory($publicDirectory, $outputDirectory);
foreach (['index.php', '.htaccess'] as $serverFile) {
    $path = $outputDirectory.DIRECTORY_SEPARATOR.$serverFile;
    is_file($path) && unlink($path);
}
file_put_contents($outputDirectory.'/.nojekyll', '');

$routes = ['', 'about', 'competition', 'athletes', 'timetable', 'news', 'media', 'results', 'contact'];
foreach (config('event.news') as $article) {
    $routes[] = 'news/'.$article['slug'];
}

$kernel = $app->make(Kernel::class);
foreach ($routes as $route) {
    $response = $kernel->handle(Request::create('/'.trim($route, '/'), 'GET'));
    if ($response->getStatusCode() !== 200) {
        throw new RuntimeException("Unable to export /{$route}: HTTP {$response->getStatusCode()}");
    }

    $html = preg_replace('~<script id="browser-logger-active">.*?</script>~s', '', $response->getContent());
    $html = str_replace($repositoryUrl.'//', $repositoryUrl.'/', $html);
    $html = makeStaticLinks($html, $routes);
    $path = $outputDirectory.DIRECTORY_SEPARATOR.staticPath($route);
    is_dir(dirname($path)) || mkdir(dirname($path), 0777, true);
    file_put_contents($path, $html);
    $kernel->terminate(Request::create('/'.trim($route, '/'), 'GET'), $response);
}

echo "Static export created in {$outputDirectory}".PHP_EOL;
