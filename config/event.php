<?php

return [
    'name' => 'AURORA TRACK NIGHT',
    'tagline' => 'Where the night runs brighter.',
    'date' => '18 JULY 2027',
    'venue' => 'Riverside Athletics Stadium',
    'location' => 'Your City · International Meeting',
    'email' => 'hello@auroratracknight.test',
    'phone' => '+00 000 000 000',
    'hero' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=2200&q=85',
    'images' => [
        'track' => 'https://images.unsplash.com/photo-1530137073520-26d14c8c5f72?auto=format&fit=crop&w=1400&q=80',
        'field' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=1400&q=80',
        'crowd' => 'https://images.unsplash.com/photo-1502904550040-7534597429ae?auto=format&fit=crop&w=1400&q=80',
    ],
    'athletes' => [
        ['name' => 'Mara Voss', 'country' => 'NLD', 'discipline' => '400m', 'pb' => '50.12', 'sb' => '50.48', 'image' => 'https://images.unsplash.com/photo-1599058917212-d750089bc07e?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Elias Nkomo', 'country' => 'ZAF', 'discipline' => '800m', 'pb' => '1:43.88', 'sb' => '1:44.61', 'image' => 'https://images.unsplash.com/photo-1550345332-09e3ac987658?auto=format&fit=crop&w=700&q=80'],
        ['name' => 'Sofia Laurent', 'country' => 'FRA', 'discipline' => 'Long Jump', 'pb' => '6.82m', 'sb' => '6.69m', 'image' => 'https://images.unsplash.com/photo-1517836357463-d25dfeac3438?auto=format&fit=crop&w=700&q=80'],
    ],
    'news' => [
        ['slug' => 'the-night-session-takes-shape', 'date' => '06.03.2027', 'category' => 'Meeting update', 'title' => 'The night session takes shape', 'excerpt' => 'A first look at the pace, precision and atmosphere being built for Aurora Track Night.', 'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1000&q=80'],
        ['slug' => 'a-new-stage-for-field-events', 'date' => '21.02.2027', 'category' => 'Venue', 'title' => 'A new stage for field events', 'excerpt' => 'The infield is designed so every take-off, throw and landing can be felt from the stands.', 'image' => 'https://images.unsplash.com/photo-1593113646773-028c64a8f1b8?auto=format&fit=crop&w=1000&q=80'],
        ['slug' => 'volunteers-open-the-gates', 'date' => '10.02.2027', 'category' => 'Community', 'title' => 'Volunteers open the gates', 'excerpt' => 'Meet the team that will turn an ordinary July evening into a shared occasion.', 'image' => 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=1000&q=80'],
    ],
    'schedules' => [
        'amateur' => [['time'=>'15:00','event'=>'Gates & participant check-in','class'=>'All participants'],['time'=>'16:00','event'=>'Community 100m heats','class'=>'Women & men'],['time'=>'17:10','event'=>'Open long jump','class'=>'Mixed'],['time'=>'18:00','event'=>'Community mile','class'=>'All participants'],['time'=>'19:15','event'=>'Awards & closing lap','class'=>'All participants']],
        'elite' => [['time'=>'18:30','event'=>'Women’s pole vault','class'=>'Final'],['time'=>'19:00','event'=>'Men’s 800m','class'=>'A race'],['time'=>'19:18','event'=>'Women’s 400m','class'=>'A race'],['time'=>'19:35','event'=>'Men’s long jump','class'=>'Final'],['time'=>'20:05','event'=>'Women’s 1500m','class'=>'A race'],['time'=>'20:25','event'=>'Men’s 100m','class'=>'A race'],['time'=>'20:45','event'=>'Closing ceremony','class'=>'Presentation']],
    ],
];
