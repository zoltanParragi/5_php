<?php
$a = 3.5;

// if, elseif, else
if($a > 4) {
    print 'more than 4';
}
elseif($a > 3) {
    print 'more than 3';
}
else{
    print 'no more than 3';
}

// switch, 2 version
// Without 'break'-s every true case will be executed.
switch($a) {
    case 4:
        print 'It is 4.';
        break;
    case 3.5:
        print 'It is 3.5';
        break;
    default:
        print 'Misterious number.';
};

switch(true) {
    case $a > 4:
        print 'More than 4';
        break;
    case $a > 3:
        print "Wow, it's more than 3.";
        break;
    default:
        print 'Tricky number.';
        
}

//arrays
//two types of array declaration:
$b = Array('item1', 'item2 ', 'item3', 'item4');
$c = ['i1', 'i2 ', 'i3', 'i4'];
print_r( $c );
print $b[2];
var_dump($b); // print with more info
//It does not prints but returns the things: print_r( $c, 1 )
$data = print_r( $c, 1 );
print $data.'**** <br>';

// array with for loop,    sizeof() === count()
for($i = 0; $i < count($c); $i++) {
    print $c[$i];
}
print ' - for loop <br>';

// array with foreach
foreach($b as $item) {
    print $item. " ";
}
print  '- foreach <br>';

// associative array
$d = [
        'name'=>'Béla',
        'location'=>'Nekeresd',
        'email'=>'asd@asd.asd'
];

foreach($d as $key => $value) {
    print 'This is a key: '.$key." and this is its value: ".$value."<br>";
}

$belaim = [
    [
        'name'=>'Béla1',
        'location'=>'Nekeresd1',
        'email'=>'asd@asd.asd1'
    ],
    [
        'name'=>'Béla2',
        'location'=>'Nekeresd2',
        'email'=>'asd@asd.asd2'
    ],
    [
        'name'=>'Béla3',
        'location'=>'Nekeresd3',
        'email'=>'asd@asd.asd3'
    ]
];

foreach($belaim as $bela) {
    print 'Név: '.$bela['name'].'<br>';
}

foreach($belaim as $bela) {
    foreach($bela as $userdata) {
        print $userdata.'-';
    }
    print '<br>';
}
// data in table version 1
print '<table border=1 cellpadding=5 align="center">';
foreach($belaim as $bela) {
    print '<tr>';
    foreach($bela as $userdata) {
        print '<td>'.$userdata.'</td>';
    }
    print '</tr>';
}
print '</table><br>';

// data in table version 2
print '<table border=1 cellpadding=5 align="center">';
foreach($belaim as $bela) {
    print '<tr>';
    foreach($bela as $key => $userdata) {
        print '<td>'.$key.'</td>';
    }
    print '</tr>';

    print '<tr>';
    foreach($bela as $userdata) {
        print '<td>'.$userdata.'</td>';
    }
    print '</tr>';
}
print '</table>';
print '<br>';

// data in table version 3
$tableHeadNames = [
    'name'=>'Név',
    'location'=>'Lakhely',
    'email'=>'Email cím'
];
$index = 0;

print '<table border=1 cellpadding=5 align="center">';
foreach($belaim as $bela) {
    if(!$index) {
        print '<tr>';
        foreach($bela as $key => $userdata) {
            print '<td>'.$tableHeadNames[$key].'</td>';
        }
        print '</tr>';
    }
    $index++;
    print '<tr>';
    foreach($bela as $userdata) {
        print '<td>'.$userdata.'</td>';
    }
    print '</tr>';
}
print '</table>';
print '<br>';

// break, continue in for, foreach, while loops

for($i=0; $i<10; $i++) {
    if($i==5) {
        continue;
    } else {
        print 'for loop, element: '.$i;
    }
}

print '<br>';
for($i=0; $i<10; $i++) {
    if($i==5) {
        break;
    } else {
        print 'for loop, element: '.$i;
    }
}

print '<br>';
$f = 0;
while($f < 10) {
    print 'while loop, element: '.$f.' ';
    $f++;
}

print '<br>';
$g = 0;
while($g < 10) {
    if($g==3) {
        $g++;
        continue;
    }
        print 'while loop, element: '.$g.' ';
        $g++;
}


print '<br>';
$h = 0;
while($h < 10) {
    if($h==3) {
        break;
    }
        print 'while loop, element: '.$h.' ';
        $h++;
}
