<?php

remove_filter( 'the_title_rss', 'strip_tags');
function cs_get_google_init_arrays(){
$font_list_init = array
	(
	'ABeeZee' => 'ABeeZee',
	'Abel' => 'Abel',
	'Abril Fatface' => 'Abril Fatface',
	'Aclonica' => 'Aclonica',
	'Acme' => 'Acme',
	'Actor' => 'Actor',
	'Adamina' => 'Adamina',
	'Advent Pro' => 'Advent Pro',
	'Aguafina Script' => 'Aguafina Script',
	'Akronim' => 'Akronim',
	'Aladin' => 'Aladin',
	'Aldrich' => 'Aldrich',
	'Alegreya' => 'Alegreya',
	'Alegreya SC' => 'Alegreya SC',
	'Alex Brush' => 'Alex Brush',
	'Alfa Slab One' => 'Alfa Slab One',
	'Alice' => 'Alice',
	'Alike' => 'Alike',
	'Alike Angular' => 'Alike Angular',
	'Allan' => 'Allan',
	'Allerta' => 'Allerta',
	'Allerta Stencil' => 'Allerta Stencil',
	'Allura' => 'Allura',
	'Almendra' => 'Almendra',
	'Almendra Display' => 'Almendra Display',
	'Almendra SC' => 'Almendra SC',
	'Amarante' => 'Amarante',
	'Amaranth' => 'Amaranth',
	'Amatic SC' => 'Amatic SC',
	'Amethysta' => 'Amethysta',
	'Anaheim' => 'Anaheim',
	'Andada' => 'Andada',
	'Andika' => 'Andika',
	'Angkor' => 'Angkor',
	'Annie Use Your Telescope' => 'Annie Use Your Telescope',
	'Anonymous Pro' => 'Anonymous Pro',
	'Antic' => 'Antic',
	'Antic Didone' => 'Antic Didone',
	'Antic Slab' => 'Antic Slab',
	'Anton' => 'Anton',
	'Arapey' => 'Arapey',
	'Arbutus' => 'Arbutus',
	'Arbutus Slab' => 'Arbutus Slab',
	'Architects Daughter' => 'Architects Daughter',
	'Archivo Black' => 'Archivo Black',
	'Archivo Narrow' => 'Archivo Narrow',
	'Arimo' => 'Arimo',
	'Arizonia' => 'Arizonia',
	'Armata' => 'Armata',
	'Artifika' => 'Artifika',
	'Arvo' => 'Arvo',
	'Asap' => 'Asap',
	'Asset' => 'Asset',
	'Astloch' => 'Astloch',
	'Asul' => 'Asul',
	'Atomic Age' => 'Atomic Age',
	'Aubrey' => 'Aubrey',
	'Audiowide' => 'Audiowide',
	'Autour One' => 'Autour One',
	'Average' => 'Average',
	'Average Sans' => 'Average Sans',
	'Averia Gruesa Libre' => 'Averia Gruesa Libre',
	'Averia Libre' => 'Averia Libre',
	'Averia Sans Libre' => 'Averia Sans Libre',
	'Averia Serif Libre' => 'Averia Serif Libre',
	'Bad Script' => 'Bad Script',
	'Balthazar' => 'Balthazar',
	'Bangers' => 'Bangers',
	'Basic' => 'Basic',
	'Battambang' => 'Battambang',
	'Baumans' => 'Baumans',
	'Bayon' => 'Bayon',
	'Belgrano' => 'Belgrano',
	'Belleza' => 'Belleza',
	'BenchNine' => 'BenchNine',
	'Bentham' => 'Bentham',
	'Berkshire Swash' => 'Berkshire Swash',
	'Bevan' => 'Bevan',
	'Bigelow Rules' => 'Bigelow Rules',
	'Bigshot One' => 'Bigshot One',
	'Bilbo' => 'Bilbo',
	'Bilbo Swash Caps' => 'Bilbo Swash Caps',
	'Bitter' => 'Bitter',
	'Black Ops One' => 'Black Ops One',
	'Bokor' => 'Bokor',
	'Bonbon' => 'Bonbon',
	'Boogaloo' => 'Boogaloo',
	'Bowlby One' => 'Bowlby One',
	'Bowlby One SC' => 'Bowlby One SC',
	'Brawler' => 'Brawler',
	'Bree Serif' => 'Bree Serif',
	'Bubblegum Sans' => 'Bubblegum Sans',
	'Bubbler One' => 'Bubbler One',
	'Buda' => 'Buda',
	'Buenard' => 'Buenard',
	'Butcherman' => 'Butcherman',
	'Butterfly Kids' => 'Butterfly Kids',
	'Cabin' => 'Cabin',
	'Cabin Condensed' => 'Cabin Condensed',
	'Cabin Sketch' => 'Cabin Sketch',
	'Caesar Dressing' => 'Caesar Dressing',
	'Cagliostro' => 'Cagliostro',
	'Calligraffitti' => 'Calligraffitti',
	'Cambo' => 'Cambo',
	'Candal' => 'Candal',
	'Cantarell' => 'Cantarell',
	'Cantata One' => 'Cantata One',
	'Cantora One' => 'Cantora One',
	'Capriola' => 'Capriola',
	'Cardo' => 'Cardo',
	'Carme' => 'Carme',
	'Carrois Gothic' => 'Carrois Gothic',
	'Carrois Gothic SC' => 'Carrois Gothic SC',
	'Carter One' => 'Carter One',
	'Caudex' => 'Caudex',
	'Cedarville Cursive' => 'Cedarville Cursive',
	'Ceviche One' => 'Ceviche One',
	'Changa One' => 'Changa One',
	'Chango' => 'Chango',
	'Chau Philomene One' => 'Chau Philomene One',
	'Chela One' => 'Chela One',
	'Chelsea Market' => 'Chelsea Market',
	'Chenla' => 'Chenla',
	'Cherry Cream Soda' => 'Cherry Cream Soda',
	'Cherry Swash' => 'Cherry Swash',
	'Chewy' => 'Chewy',
	'Chicle' => 'Chicle',
	'Chivo' => 'Chivo',
	'Cinzel' => 'Cinzel',
	'Cinzel Decorative' => 'Cinzel Decorative',
	'Clicker Script' => 'Clicker Script',
	'Coda' => 'Coda',
	'Coda Caption' => 'Coda Caption',
	'Codystar' => 'Codystar',
	'Combo' => 'Combo',
	'Comfortaa' => 'Comfortaa',
	'Coming Soon' => 'Coming Soon',
	'Concert One' => 'Concert One',
	'Condiment' => 'Condiment',
	'Content' => 'Content',
	'Contrail One' => 'Contrail One',
	'Convergence' => 'Convergence',
	'Cookie' => 'Cookie',
	'Copse' => 'Copse',
	'Corben' => 'Corben',
	'Courgette' => 'Courgette',
	'Cousine' => 'Cousine',
	'Coustard' => 'Coustard',
	'Covered By Your Grace' => 'Covered By Your Grace',
	'Crafty Girls' => 'Crafty Girls',
	'Creepster' => 'Creepster',
	'Crete Round' => 'Crete Round',
	'Crimson Text' => 'Crimson Text',
	'Croissant One' => 'Croissant One',
	'Crushed' => 'Crushed',
	'Cuprum' => 'Cuprum',
	'Cutive' => 'Cutive',
	'Cutive Mono' => 'Cutive Mono',
	'Damion' => 'Damion',
	'Dancing Script' => 'Dancing Script',
	'Dangrek' => 'Dangrek',
	'Dawning of a New Day' => 'Dawning of a New Day',
	'Days One' => 'Days One',
	'Delius' => 'Delius',
	'Delius Swash Caps' => 'Delius Swash Caps',
	'Delius Unicase' => 'Delius Unicase',
	'Della Respira' => 'Della Respira',
	'Denk One' => 'Denk One',
	'Devonshire' => 'Devonshire',
	'Didact Gothic' => 'Didact Gothic',
	'Diplomata' => 'Diplomata',
	'Diplomata SC' => 'Diplomata SC',
	'Domine' => 'Domine',
	'Donegal One' => 'Donegal One',
	'Doppio One' => 'Doppio One',
	'Dorsa' => 'Dorsa',
	'Dosis' => 'Dosis',
	'Dr Sugiyama' => 'Dr Sugiyama',
	'Droid Sans' => 'Droid Sans',
	'Droid Sans Mono' => 'Droid Sans Mono',
	'Droid Serif' => 'Droid Serif',
	'Duru Sans' => 'Duru Sans',
	'Dynalight' => 'Dynalight',
	'EB Garamond' => 'EB Garamond',
	'Eagle Lake' => 'Eagle Lake',
	'Eater' => 'Eater',
	'Economica' => 'Economica',
	'Electrolize' => 'Electrolize',
	'Elsie' => 'Elsie',
	'Elsie Swash Caps' => 'Elsie Swash Caps',
	'Emblema One' => 'Emblema One',
	'Emilys Candy' => 'Emilys Candy',
	'Engagement' => 'Engagement',
	'Englebert' => 'Englebert',
	'Enriqueta' => 'Enriqueta',
	'Erica One' => 'Erica One',
	'Esteban' => 'Esteban',
	'Euphoria Script' => 'Euphoria Script',
	'Ewert' => 'Ewert',
	'Exo' => 'Exo',
	'Expletus Sans' => 'Expletus Sans',
	'Fanwood Text' => 'Fanwood Text',
	'Fascinate' => 'Fascinate',
	'Fascinate Inline' => 'Fascinate Inline',
	'Faster One' => 'Faster One',
	'Fasthand' => 'Fasthand',
	'Federant' => 'Federant',
	'Federo' => 'Federo',
	'Felipa' => 'Felipa',
	'Fenix' => 'Fenix',
	'Finger Paint' => 'Finger Paint',
	'Fjalla One' => 'Fjalla One',
	'Fjord One' => 'Fjord One',
	'Flamenco' => 'Flamenco',
	'Flavors' => 'Flavors',
	'Fondamento' => 'Fondamento',
	'Fontdiner Swanky' => 'Fontdiner Swanky',
	'Forum' => 'Forum',
	'Francois One' => 'Francois One',
	'Freckle Face' => 'Freckle Face',
	'Fredericka the Great' => 'Fredericka the Great',
	'Fredoka One' => 'Fredoka One',
	'Freehand' => 'Freehand',
	'Fresca' => 'Fresca',
	'Frijole' => 'Frijole',
	'Fruktur' => 'Fruktur',
	'Fugaz One' => 'Fugaz One',
	'GFS Didot' => 'GFS Didot',
	'GFS Neohellenic' => 'GFS Neohellenic',
	'Gabriela' => 'Gabriela',
	'Gafata' => 'Gafata',
	'Galdeano' => 'Galdeano',
	'Galindo' => 'Galindo',
	'Gentium Basic' => 'Gentium Basic',
	'Gentium Book Basic' => 'Gentium Book Basic',
	'Geo' => 'Geo',
	'Geostar' => 'Geostar',
	'Geostar Fill' => 'Geostar Fill',
	'Germania One' => 'Germania One',
	'Gilda Display' => 'Gilda Display',
	'Give You Glory' => 'Give You Glory',
	'Glass Antiqua' => 'Glass Antiqua',
	'Glegoo' => 'Glegoo',
	'Gloria Hallelujah' => 'Gloria Hallelujah',
	'Goblin One' => 'Goblin One',
	'Gochi Hand' => 'Gochi Hand',
	'Gorditas' => 'Gorditas',
	'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
	'Graduate' => 'Graduate',
	'Grand Hotel' => 'Grand Hotel',
	'Gravitas One' => 'Gravitas One',
	'Great Vibes' => 'Great Vibes',
	'Griffy' => 'Griffy',
	'Gruppo' => 'Gruppo',
	'Gudea' => 'Gudea',
	'Habibi' => 'Habibi',
	'Hammersmith One' => 'Hammersmith One',
	'Hanalei' => 'Hanalei',
	'Hanalei Fill' => 'Hanalei Fill',
	'Handlee' => 'Handlee',
	'Hanuman' => 'Hanuman',
	'Happy Monkey' => 'Happy Monkey',
	'Headland One' => 'Headland One',
	'Henny Penny' => 'Henny Penny',
	'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
	'Holtwood One SC' => 'Holtwood One SC',
	'Homemade Apple' => 'Homemade Apple',
	'Homenaje' => 'Homenaje',
	'IM Fell DW Pica' => 'IM Fell DW Pica',
	'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
	'IM Fell Double Pica' => 'IM Fell Double Pica',
	'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
	'IM Fell English' => 'IM Fell English',
	'IM Fell English SC' => 'IM Fell English SC',
	'IM Fell French Canon' => 'IM Fell French Canon',
	'IM Fell French Canon SC' => 'IM Fell French Canon SC',
	'IM Fell Great Primer' => 'IM Fell Great Primer',
	'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
	'Iceberg' => 'Iceberg',
	'Iceland' => 'Iceland',
	'Imprima' => 'Imprima',
	'Inconsolata' => 'Inconsolata',
	'Inder' => 'Inder',
	'Indie Flower' => 'Indie Flower',
	'Inika' => 'Inika',
	'Irish Grover' => 'Irish Grover',
	'Istok Web' => 'Istok Web',
	'Italiana' => 'Italiana',
	'Italianno' => 'Italianno',
	'Jacques Francois' => 'Jacques Francois',
	'Jacques Francois Shadow' => 'Jacques Francois Shadow',
	'Jim Nightshade' => 'Jim Nightshade',
	'Jockey One' => 'Jockey One',
	'Jolly Lodger' => 'Jolly Lodger',
	'Josefin Sans' => 'Josefin Sans',
	'Josefin Slab' => 'Josefin Slab',
	'Joti One' => 'Joti One',
	'Judson' => 'Judson',
	'Julee' => 'Julee',
	'Julius Sans One' => 'Julius Sans One',
	'Junge' => 'Junge',
	'Jura' => 'Jura',
	'Just Another Hand' => 'Just Another Hand',
	'Just Me Again Down Here' => 'Just Me Again Down Here',
	'Kameron' => 'Kameron',
	'Karla' => 'Karla',
	'Kaushan Script' => 'Kaushan Script',
	'Kavoon' => 'Kavoon',
	'Keania One' => 'Keania One',
	'Kelly Slab' => 'Kelly Slab',
	'Kenia' => 'Kenia',
	'Khmer' => 'Khmer',
	'Kite One' => 'Kite One',
	'Knewave' => 'Knewave',
	'Kotta One' => 'Kotta One',
	'Koulen' => 'Koulen',
	'Kranky' => 'Kranky',
	'Kreon' => 'Kreon',
	'Kristi' => 'Kristi',
	'Krona One' => 'Krona One',
	'La Belle Aurore' => 'La Belle Aurore',
	'Lancelot' => 'Lancelot',
	'Lato' => 'Lato',
	'League Script' => 'League Script',
	'Leckerli One' => 'Leckerli One',
	'Ledger' => 'Ledger',
	'Lekton' => 'Lekton',
	'Lemon' => 'Lemon',
	'Libre Baskerville' => 'Libre Baskerville',
	'Life Savers' => 'Life Savers',
	'Lilita One' => 'Lilita One',
	'Limelight' => 'Limelight',
	'Linden Hill' => 'Linden Hill',
	'Lobster' => 'Lobster',
	'Lobster Two' => 'Lobster Two',
	'Londrina Outline' => 'Londrina Outline',
	'Londrina Shadow' => 'Londrina Shadow',
	'Londrina Sketch' => 'Londrina Sketch',
	'Londrina Solid' => 'Londrina Solid',
	'Lora' => 'Lora',
	'Love Ya Like A Sister' => 'Love Ya Like A Sister',
	'Loved by the King' => 'Loved by the King',
	'Lovers Quarrel' => 'Lovers Quarrel',
	'Luckiest Guy' => 'Luckiest Guy',
	'Lusitana' => 'Lusitana',
	'Lustria' => 'Lustria',
	'Macondo' => 'Macondo',
	'Macondo Swash Caps' => 'Macondo Swash Caps',
	'Magra' => 'Magra',
	'Maiden Orange' => 'Maiden Orange',
	'Mako' => 'Mako',
	'Marcellus' => 'Marcellus',
	'Marcellus SC' => 'Marcellus SC',
	'Marck Script' => 'Marck Script',
	'Margarine' => 'Margarine',
	'Marko One' => 'Marko One',
	'Marmelad' => 'Marmelad',
	'Marvel' => 'Marvel',
	'Mate' => 'Mate',
	'Mate SC' => 'Mate SC',
	'Maven Pro' => 'Maven Pro',
	'McLaren' => 'McLaren',
	'Meddon' => 'Meddon',
	'MedievalSharp' => 'MedievalSharp',
	'Medula One' => 'Medula One',
	'Megrim' => 'Megrim',
	'Meie Script' => 'Meie Script',
	'Merienda' => 'Merienda',
	'Merienda One' => 'Merienda One',
	'Merriweather' => 'Merriweather',
	'Merriweather Sans' => 'Merriweather Sans',
	'Metal' => 'Metal',
	'Metal Mania' => 'Metal Mania',
	'Metamorphous' => 'Metamorphous',
	'Metrophobic' => 'Metrophobic',
	'Michroma' => 'Michroma',
	'Milonga' => 'Milonga',
	'Miltonian' => 'Miltonian',
	'Miltonian Tattoo' => 'Miltonian Tattoo',
	'Miniver' => 'Miniver',
	'Miss Fajardose' => 'Miss Fajardose',
	'Modern Antiqua' => 'Modern Antiqua',
	'Molengo' => 'Molengo',
	'Molle' => 'Molle',
	'Monda' => 'Monda',
	'Monofett' => 'Monofett',
	'Monoton' => 'Monoton',
	'Monsieur La Doulaise' => 'Monsieur La Doulaise',
	'Montaga' => 'Montaga',
	'Montez' => 'Montez',
	'Montserrat' => 'Montserrat',
	'Montserrat Alternates' => 'Montserrat Alternates',
	'Montserrat Subrayada' => 'Montserrat Subrayada',
	'Moul' => 'Moul',
	'Moulpali' => 'Moulpali',
	'Mountains of Christmas' => 'Mountains of Christmas',
	'Mouse Memoirs' => 'Mouse Memoirs',
	'Mr Bedfort' => 'Mr Bedfort',
	'Mr Dafoe' => 'Mr Dafoe',
	'Mr De Haviland' => 'Mr De Haviland',
	'Mrs Saint Delafield' => 'Mrs Saint Delafield',
	'Mrs Sheppards' => 'Mrs Sheppards',
	'Muli' => 'Muli',
	'Mystery Quest' => 'Mystery Quest',
	'Neucha' => 'Neucha',
	'Neuton' => 'Neuton',
	'New Rocker' => 'New Rocker',
	'News Cycle' => 'News Cycle',
	'Niconne' => 'Niconne',
	'Nixie One' => 'Nixie One',
	'Nobile' => 'Nobile',
	'Nokora' => 'Nokora',
	'Norican' => 'Norican',
	'Nosifer' => 'Nosifer',
	'Nothing You Could Do' => 'Nothing You Could Do',
	'Noticia Text' => 'Noticia Text',
	'Nova Cut' => 'Nova Cut',
	'Nova Flat' => 'Nova Flat',
	'Nova Mono' => 'Nova Mono',
	'Nova Oval' => 'Nova Oval',
	'Nova Round' => 'Nova Round',
	'Nova Script' => 'Nova Script',
	'Nova Slim' => 'Nova Slim',
	'Nova Square' => 'Nova Square',
	'Numans' => 'Numans',
	'Nunito' => 'Nunito',
	'Odor Mean Chey' => 'Odor Mean Chey',
	'Offside' => 'Offside',
	'Old Standard TT' => 'Old Standard TT',
	'Oldenburg' => 'Oldenburg',
	'Oleo Script' => 'Oleo Script',
	'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
	'Open Sans' => 'Open Sans',
	'Open Sans Condensed' => 'Open Sans Condensed',
	'Oranienbaum' => 'Oranienbaum',
	'Orbitron' => 'Orbitron',
	'Oregano' => 'Oregano',
	'Orienta' => 'Orienta',
	'Original Surfer' => 'Original Surfer',
	'Oswald' => 'Oswald',
	'Over the Rainbow' => 'Over the Rainbow',
	'Overlock' => 'Overlock',
	'Overlock SC' => 'Overlock SC',
	'Ovo' => 'Ovo',
	'Oxygen' => 'Oxygen',
	'Oxygen Mono' => 'Oxygen Mono',
	'PT Mono' => 'PT Mono',
	'PT Sans' => 'PT Sans',
	'PT Sans Caption' => 'PT Sans Caption',
	'PT Sans Narrow' => 'PT Sans Narrow',
	'PT Serif' => 'PT Serif',
	'PT Serif Caption' => 'PT Serif Caption',
	'Pacifico' => 'Pacifico',
	'Paprika' => 'Paprika',
	'Parisienne' => 'Parisienne',
	'Passero One' => 'Passero One',
	'Passion One' => 'Passion One',
	'Patrick Hand' => 'Patrick Hand',
	'Patrick Hand SC' => 'Patrick Hand SC',
	'Patua One' => 'Patua One',
	'Paytone One' => 'Paytone One',
	'Peralta' => 'Peralta',
	'Permanent Marker' => 'Permanent Marker',
	'Petit Formal Script' => 'Petit Formal Script',
	'Petrona' => 'Petrona',
	'Philosopher' => 'Philosopher',
	'Piedra' => 'Piedra',
	'Pinyon Script' => 'Pinyon Script',
	'Pirata One' => 'Pirata One',
	'Plaster' => 'Plaster',
	'Play' => 'Play',
	'Playball' => 'Playball',
	'Playfair Display' => 'Playfair Display',
	'Playfair Display SC' => 'Playfair Display SC',
	'Podkova' => 'Podkova',
	'Poiret One' => 'Poiret One',
	'Poller One' => 'Poller One',
	'Poly' => 'Poly',
	'Pompiere' => 'Pompiere',
	'Pontano Sans' => 'Pontano Sans',
	'Port Lligat Sans' => 'Port Lligat Sans',
	'Port Lligat Slab' => 'Port Lligat Slab',
	'Prata' => 'Prata',
	'Preahvihear' => 'Preahvihear',
	'Press Start 2P' => 'Press Start 2P',
	'Princess Sofia' => 'Princess Sofia',
	'Prociono' => 'Prociono',
	'Prosto One' => 'Prosto One',
	'Puritan' => 'Puritan',
	'Purple Purse' => 'Purple Purse',
	'Quando' => 'Quando',
	'Quantico' => 'Quantico',
	'Quattrocento' => 'Quattrocento',
	'Quattrocento Sans' => 'Quattrocento Sans',
	'Questrial' => 'Questrial',
	'Quicksand' => 'Quicksand',
	'Quintessential' => 'Quintessential',
	'Qwigley' => 'Qwigley',
	'Racing Sans One' => 'Racing Sans One',
	'Radley' => 'Radley',
	'Raleway' => 'Raleway',
	'Raleway Dots' => 'Raleway Dots',
	'Rambla' => 'Rambla',
	'Rammetto One' => 'Rammetto One',
	'Ranchers' => 'Ranchers',
	'Rancho' => 'Rancho',
	'Rationale' => 'Rationale',
	'Redressed' => 'Redressed',
	'Reenie Beanie' => 'Reenie Beanie',
	'Revalia' => 'Revalia',
	'Ribeye' => 'Ribeye',
	'Ribeye Marrow' => 'Ribeye Marrow',
	'Righteous' => 'Righteous',
	'Risque' => 'Risque',
	'Roboto' => 'Roboto',
	'Roboto Condensed' => 'Roboto Condensed',
	'Rochester' => 'Rochester',
	'Rock Salt' => 'Rock Salt',
	'Rokkitt' => 'Rokkitt',
	'Romanesco' => 'Romanesco',
	'Ropa Sans' => 'Ropa Sans',
	'Rosario' => 'Rosario',
	'Rosarivo' => 'Rosarivo',
	'Rouge Script' => 'Rouge Script',
	'Ruda' => 'Ruda',
	'Rufina' => 'Rufina',
	'Ruge Boogie' => 'Ruge Boogie',
	'Ruluko' => 'Ruluko',
	'Rum Raisin' => 'Rum Raisin',
	'Ruslan Display' => 'Ruslan Display',
	'Russo One' => 'Russo One',
	'Ruthie' => 'Ruthie',
	'Rye' => 'Rye',
	'Sacramento' => 'Sacramento',
	'Sail' => 'Sail',
	'Salsa' => 'Salsa',
	'Sanchez' => 'Sanchez',
	'Sancreek' => 'Sancreek',
	'Sansita One' => 'Sansita One',
	'Sarina' => 'Sarina',
	'Satisfy' => 'Satisfy',
	'Scada' => 'Scada',
	'Schoolbell' => 'Schoolbell',
	'Seaweed Script' => 'Seaweed Script',
	'Sevillana' => 'Sevillana',
	'Seymour One' => 'Seymour One',
	'Shadows Into Light' => 'Shadows Into Light',
	'Shadows Into Light Two' => 'Shadows Into Light Two',
	'Shanti' => 'Shanti',
	'Share' => 'Share',
	'Share Tech' => 'Share Tech',
	'Share Tech Mono' => 'Share Tech Mono',
	'Shojumaru' => 'Shojumaru',
	'Short Stack' => 'Short Stack',
	'Siemreap' => 'Siemreap',
	'Sigmar One' => 'Sigmar One',
	'Signika' => 'Signika',
	'Signika Negative' => 'Signika Negative',
	'Simonetta' => 'Simonetta',
	'Sintony' => 'Sintony',
	'Sirin Stencil' => 'Sirin Stencil',
	'Six Caps' => 'Six Caps',
	'Skranji' => 'Skranji',
	'Slackey' => 'Slackey',
	'Smokum' => 'Smokum',
	'Smythe' => 'Smythe',
	'Sniglet' => 'Sniglet',
	'Snippet' => 'Snippet',
	'Snowburst One' => 'Snowburst One',
	'Sofadi One' => 'Sofadi One',
	'Sofia' => 'Sofia',
	'Sonsie One' => 'Sonsie One',
	'Sorts Mill Goudy' => 'Sorts Mill Goudy',
	'Source Code Pro' => 'Source Code Pro',
	'Source Sans Pro' => 'Source Sans Pro',
	'Special Elite' => 'Special Elite',
	'Spicy Rice' => 'Spicy Rice',
	'Spinnaker' => 'Spinnaker',
	'Spirax' => 'Spirax',
	'Squada One' => 'Squada One',
	'Stalemate' => 'Stalemate',
	'Stalinist One' => 'Stalinist One',
	'Stardos Stencil' => 'Stardos Stencil',
	'Stint Ultra Condensed' => 'Stint Ultra Condensed',
	'Stint Ultra Expanded' => 'Stint Ultra Expanded',
	'Stoke' => 'Stoke',
	'Strait' => 'Strait',
	'Sue Ellen Francisco' => 'Sue Ellen Francisco',
	'Sunshiney' => 'Sunshiney',
	'Supermercado One' => 'Supermercado One',
	'Suwannaphum' => 'Suwannaphum',
	'Swanky and Moo Moo' => 'Swanky and Moo Moo',
	'Syncopate' => 'Syncopate',
	'Tangerine' => 'Tangerine',
	'Taprom' => 'Taprom',
	'Tauri' => 'Tauri',
	'Telex' => 'Telex',
	'Tenor Sans' => 'Tenor Sans',
	'Text Me One' => 'Text Me One',
	'The Girl Next Door' => 'The Girl Next Door',
	'Tienne' => 'Tienne',
	'Tinos' => 'Tinos',
	'Titan One' => 'Titan One',
	'Titillium Web' => 'Titillium Web',
	'Trade Winds' => 'Trade Winds',
	'Trocchi' => 'Trocchi',
	'Trochut' => 'Trochut',
	'Trykker' => 'Trykker',
	'Tulpen One' => 'Tulpen One',
	'Ubuntu' => 'Ubuntu',
	'Ubuntu Condensed' => 'Ubuntu Condensed',
	'Ubuntu Mono' => 'Ubuntu Mono',
	'Ultra' => 'Ultra',
	'Uncial Antiqua' => 'Uncial Antiqua',
	'Underdog' => 'Underdog',
	'Unica One' => 'Unica One',
	'UnifrakturCook' => 'UnifrakturCook',
	'UnifrakturMaguntia' => 'UnifrakturMaguntia',
	'Unkempt' => 'Unkempt',
	'Unlock' => 'Unlock',
	'Unna' => 'Unna',
	'VT323' => 'VT323',
	'Vampiro One' => 'Vampiro One',
	'Varela' => 'Varela',
	'Varela Round' => 'Varela Round',
	'Vast Shadow' => 'Vast Shadow',
	'Vibur' => 'Vibur',
	'Vidaloka' => 'Vidaloka',
	'Viga' => 'Viga',
	'Voces' => 'Voces',
	'Volkhov' => 'Volkhov',
	'Vollkorn' => 'Vollkorn',
	'Voltaire' => 'Voltaire',
	'Waiting for the Sunrise' => 'Waiting for the Sunrise',
	'Wallpoet' => 'Wallpoet',
	'Walter Turncoat' => 'Walter Turncoat',
	'Warnes' => 'Warnes',
	'Wellfleet' => 'Wellfleet',
	'Wendy One' => 'Wendy One',
	'Wire One' => 'Wire One',
	'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
	'Yellowtail' => 'Yellowtail',
	'Yeseva One' => 'Yeseva One',
	'Yesteryear' => 'Yesteryear',
	'Zeyada' => 'Zeyada'
	);
	
$font_atts_int = array
	(
		'ABeeZee' => array
			('0' => 'regular','1' => 'italic'),
	
		'Abel' => array
			('0' => 'regular'),
	
		'Abril Fatface' => array
			('0' => 'regular'),
	
		'Aclonica' => array
			('0' => 'regular'),
	
		'Acme' => array
			('0' => 'regular'),
	
		'Actor' => array
			('0' => 'regular'),
	
		'Adamina' => array
			('0' => 'regular'),
	
		'Advent Pro' => array
			('0' => '100','1' => '200','2' => '300','3' => 'regular','4' => '500','5' => '600','6' => '700'),
	
		'Aguafina Script' => array
			('0' => 'regular'),
	
		'Akronim' => array
			('0' => 'regular'),
	
		'Aladin' => array
			('0' => 'regular'),
	
		'Aldrich' => array
			('0' => 'regular'),
	
		'Alegreya' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic','4' => '900','5' => '900italic'),
	
		'Alegreya SC' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic','4' => '900','5' => '900italic'),
	
		'Alex Brush' => array
			('0' => 'regular'),
	
		'Alfa Slab One' => array
			('0' => 'regular'),
	
		'Alice' => array
			('0' => 'regular'),
	
		'Alike' => array
			('0' => 'regular'),
	
		'Alike Angular' => array
			('0' => 'regular'),
	
		'Allan' => array
			('0' => 'regular','1' => '700'),
	
		'Allerta' => array
			('0' => 'regular'),
	
		'Allerta Stencil' => array
			('0' => 'regular'),
	
		'Allura' => array
			('0' => 'regular'),
	
		'Almendra' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Almendra Display' => array
			('0' => 'regular'),
	
		'Almendra SC' => array
			('0' => 'regular'),
	
		'Amarante' => array
			('0' => 'regular'),
	
		'Amaranth' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Amatic SC' => array
			('0' => 'regular','1' => '700'),
	
		'Amethysta' => array
			('0' => 'regular'),
	
		'Anaheim' => array
			('0' => 'regular'),
	
		'Andada' => array
			('0' => 'regular'),
	
		'Andika' => array
			('0' => 'regular'),
	
		'Angkor' => array
			('0' => 'regular'),
	
		'Annie Use Your Telescope' => array
			('0' => 'regular'),
	
		'Anonymous Pro' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Antic' => array
			('0' => 'regular'),
	
		'Antic Didone' => array
			('0' => 'regular'),
	
		'Antic Slab' => array
			('0' => 'regular'),
	
		'Anton' => array
			('0' => 'regular'),
	
		'Arapey' => array
			('0' => 'regular','1' => 'italic'),
	
		'Arbutus' => array
			('0' => 'regular'),
	
		'Arbutus Slab' => array
			('0' => 'regular'),
	
		'Architects Daughter' => array
			('0' => 'regular'),
	
		'Archivo Black' => array
			('0' => 'regular'),
	
		'Archivo Narrow' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Arimo' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Arizonia' => array
			('0' => 'regular'),
	
		'Armata' => array
			('0' => 'regular'),
	
		'Artifika' => array
			('0' => 'regular'),
	
		'Arvo' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Asap' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Asset' => array
			('0' => 'regular'),
	
		'Astloch' => array
			('0' => 'regular','1' => '700'),
	
		'Asul' => array
			('0' => 'regular','1' => '700'),
	
		'Atomic Age' => array
			('0' => 'regular'),
	
		'Aubrey' => array
			('0' => 'regular'),
	
		'Audiowide' => array
			('0' => 'regular'),
	
		'Autour One' => array
			('0' => 'regular'),
	
		'Average' => array
			('0' => 'regular'),
	
		'Average Sans' => array
			('0' => 'regular'),
	
		'Averia Gruesa Libre' => array
			('0' => 'regular'),
	
		'Averia Libre' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '700','5' => '700italic'),
	
		'Averia Sans Libre' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '700','5' => '700italic'),
	
		'Averia Serif Libre' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '700','5' => '700italic'),
	
		'Bad Script' => array
			('0' => 'regular'),
	
		'Balthazar' => array
			('0' => 'regular'),
	
		'Bangers' => array
			('0' => 'regular'),
	
		'Basic' => array
			('0' => 'regular'),
	
		'Battambang' => array
			('0' => 'regular','1' => '700'),
	
		'Baumans' => array
			('0' => 'regular'),
	
		'Bayon' => array
			('0' => 'regular'),
	
		'Belgrano' => array
			('0' => 'regular'),
	
		'Belleza' => array
			('0' => 'regular'),
	
		'BenchNine' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Bentham' => array
			('0' => 'regular'),
	
		'Berkshire Swash' => array
			('0' => 'regular'),
	
		'Bevan' => array
			('0' => 'regular'),
	
		'Bigelow Rules' => array
			('0' => 'regular'),
	
		'Bigshot One' => array
			('0' => 'regular'),
	
		'Bilbo' => array
			('0' => 'regular'),
	
		'Bilbo Swash Caps' => array
			('0' => 'regular'),
	
		'Bitter' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Black Ops One' => array
			('0' => 'regular'),
	
		'Bokor' => array
			('0' => 'regular'),
	
		'Bonbon' => array
			('0' => 'regular'),
	
		'Boogaloo' => array
			('0' => 'regular'),
	
		'Bowlby One' => array
			('0' => 'regular'),
	
		'Bowlby One SC' => array
			('0' => 'regular'),
	
		'Brawler' => array
			('0' => 'regular'),
	
		'Bree Serif' => array
			('0' => 'regular'),
	
		'Bubblegum Sans' => array
			('0' => 'regular'),
	
		'Bubbler One' => array
			('0' => 'regular'),
	
		'Buda' => array
			('0' => '300'),
	
		'Buenard' => array
			('0' => 'regular','1' => '700'),
	
		'Butcherman' => array
			('0' => 'regular'),
	
		'Butterfly Kids' => array
			('0' => 'regular'),
	
		'Cabin' => array
			('0' => 'regular','1' => 'italic','2' => '500','3' => '500italic','4' => '600','5' => '600italic','6' => '700','7' => '700italic'),
	
		'Cabin Condensed' => array
			('0' => 'regular','1' => '500','2' => '600','3' => '700'),
	
		'Cabin Sketch' => array
			('0' => 'regular','1' => '700'),
	
		'Caesar Dressing' => array
			('0' => 'regular'),
	
		'Cagliostro' => array
			('0' => 'regular'),
	
		'Calligraffitti' => array
			('0' => 'regular'),
	
		'Cambo' => array
			('0' => 'regular'),
	
		'Candal' => array
			('0' => 'regular'),
	
		'Cantarell' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Cantata One' => array
			('0' => 'regular'),
	
		'Cantora One' => array
			('0' => 'regular'),
	
		'Capriola' => array
			('0' => 'regular'),
	
		'Cardo' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Carme' => array
			('0' => 'regular'),
	
		'Carrois Gothic' => array
			('0' => 'regular'),
	
		'Carrois Gothic SC' => array
			('0' => 'regular'),
	
		'Carter One' => array
			('0' => 'regular'),
	
		'Caudex' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Cedarville Cursive' => array
			('0' => 'regular'),
	
		'Ceviche One' => array
			('0' => 'regular'),
	
		'Changa One' => array
			('0' => 'regular','1' => 'italic'),
	
		'Chango' => array
			('0' => 'regular'),
	
		'Chau Philomene One' => array
			('0' => 'regular','1' => 'italic'),
	
		'Chela One' => array
			('0' => 'regular'),
	
		'Chelsea Market' => array
			('0' => 'regular'),
	
		'Chenla' => array
			('0' => 'regular'),
	
		'Cherry Cream Soda' => array
			('0' => 'regular'),
	
		'Cherry Swash' => array
			('0' => 'regular','1' => '700'),
	
		'Chewy' => array
			('0' => 'regular'),
	
		'Chicle' => array
			('0' => 'regular'),
	
		'Chivo' => array
			('0' => 'regular','1' => 'italic','2' => '900','3' => '900italic'),
	
		'Cinzel' => array
			('0' => 'regular','1' => '700','2' => '900'),
	
		'Cinzel Decorative' => array
			('0' => 'regular','1' => '700','2' => '900'),
	
		'Clicker Script' => array
			('0' => 'regular'),
	
		'Coda' => array
			('0' => 'regular','1' => '800'),
	
		'Coda Caption' => array
			('0' => '800'),
	
		'Codystar' => array
			('0' => '300','1' => 'regular'),
	
		'Combo' => array
			('0' => 'regular'),
	
		'Comfortaa' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Coming Soon' => array
			('0' => 'regular'),
	
		'Concert One' => array
			('0' => 'regular'),
	
		'Condiment' => array
			('0' => 'regular'),
	
		'Content' => array
			('0' => 'regular','1' => '700'),
	
		'Contrail One' => array
			('0' => 'regular'),
	
		'Convergence' => array
			('0' => 'regular'),
	
		'Cookie' => array
			('0' => 'regular'),
	
		'Copse' => array
			('0' => 'regular'),
	
		'Corben' => array
			('0' => 'regular','1' => '700'),
	
		'Courgette' => array
			('0' => 'regular'),
	
		'Cousine' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Coustard' => array
			('0' => 'regular','1' => '900'),
	
		'Covered By Your Grace' => array
			('0' => 'regular'),
	
		'Crafty Girls' => array
			('0' => 'regular'),
	
		'Creepster' => array
			('0' => 'regular'),
	
		'Crete Round' => array
			('0' => 'regular','1' => 'italic'),
	
		'Crimson Text' => array
			('0' => 'regular','1' => 'italic','2' => '600','3' => '600italic','4' => '700','5' => '700italic'),
	
		'Croissant One' => array
			('0' => 'regular'),
	
		'Crushed' => array
			('0' => 'regular'),
	
		'Cuprum' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Cutive' => array
			('0' => 'regular'),
	
		'Cutive Mono' => array
			('0' => 'regular'),
	
		'Damion' => array
			('0' => 'regular'),
	
		'Dancing Script' => array
			('0' => 'regular','1' => '700'),
	
		'Dangrek' => array
			('0' => 'regular'),
	
		'Dawning of a New Day' => array
			('0' => 'regular'),
	
		'Days One' => array
			('0' => 'regular'),
	
		'Delius' => array
			('0' => 'regular'),
	
		'Delius Swash Caps' => array
			('0' => 'regular'),
	
		'Delius Unicase' => array
			('0' => 'regular','1' => '700'),
	
		'Della Respira' => array
			('0' => 'regular'),
	
		'Denk One' => array
			('0' => 'regular'),
	
		'Devonshire' => array
			('0' => 'regular'),
	
		'Didact Gothic' => array
			('0' => 'regular'),
	
		'Diplomata' => array
			('0' => 'regular'),
	
		'Diplomata SC' => array
			('0' => 'regular'),
	
		'Domine' => array
			('0' => 'regular','1' => '700'),
	
		'Donegal One' => array
			('0' => 'regular'),
	
		'Doppio One' => array
			('0' => 'regular'),
	
		'Dorsa' => array
			('0' => 'regular'),
	
		'Dosis' => array
			('0' => '200','1' => '300','2' => 'regular','3' => '500','4' => '600','5' => '700','6' => '800'),
	
		'Dr Sugiyama' => array
			('0' => 'regular'),
	
		'Droid Sans' => array
			('0' => 'regular','1' => '700'),
	
		'Droid Sans Mono' => array
			('0' => 'regular'),
	
		'Droid Serif' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Duru Sans' => array
			('0' => 'regular'),
	
		'Dynalight' => array
			('0' => 'regular'),
	
		'EB Garamond' => array
			('0' => 'regular'),
	
		'Eagle Lake' => array
			('0' => 'regular'),
	
		'Eater' => array
			('0' => 'regular'),
	
		'Economica' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Electrolize' => array
			('0' => 'regular'),
	
		'Elsie' => array
			('0' => 'regular','1' => '900'),
	
		'Elsie Swash Caps' => array
			('0' => 'regular','1' => '900'),
	
		'Emblema One' => array
			('0' => 'regular'),
	
		'Emilys Candy' => array
			('0' => 'regular'),
	
		'Engagement' => array
			('0' => 'regular'),
	
		'Englebert' => array
			('0' => 'regular'),
	
		'Enriqueta' => array
			('0' => 'regular','1' => '700'),
	
		'Erica One' => array
			('0' => 'regular'),
	
		'Esteban' => array
			('0' => 'regular'),
	
		'Euphoria Script' => array
			('0' => 'regular'),
	
		'Ewert' => array
			('0' => 'regular'),
	
		'Exo' => array
			('0' => '100','1' => '100italic','2' => '200','3' => '200italic','4' => '300','5' => '300italic','6' => 'regular','7' => 'italic','8' => '500','9' => '500italic','10' => '600','11' => '600italic','12' => '700','13' => '700italic','14' => '800','15' => '800italic','16' => '900','17' => '900italic'),
	
		'Expletus Sans' => array
			('0' => 'regular','1' => 'italic','2' => '500','3' => '500italic','4' => '600','5' => '600italic','6' => '700','7' => '700italic'),
	
		'Fanwood Text' => array
			('0' => 'regular','1' => 'italic'),
	
		'Fascinate' => array
			('0' => 'regular'),
	
		'Fascinate Inline' => array
			('0' => 'regular'),
	
		'Faster One' => array
			('0' => 'regular'),
	
		'Fasthand' => array
			('0' => 'regular'),
	
		'Federant' => array
			('0' => 'regular'),
	
		'Federo' => array
			('0' => 'regular'),
	
		'Felipa' => array
			('0' => 'regular'),
	
		'Fenix' => array
			('0' => 'regular'),
	
		'Finger Paint' => array
			('0' => 'regular'),
	
		'Fjalla One' => array
			('0' => 'regular'),
	
		'Fjord One' => array
			('0' => 'regular'),
	
		'Flamenco' => array
			('0' => '300','1' => 'regular'),
	
		'Flavors' => array
			('0' => 'regular'),
	
		'Fondamento' => array
			('0' => 'regular','1' => 'italic'),
	
		'Fontdiner Swanky' => array
			('0' => 'regular'),
	
		'Forum' => array
			('0' => 'regular'),
	
		'Francois One' => array
			('0' => 'regular'),
	
		'Freckle Face' => array
			('0' => 'regular'),
	
		'Fredericka the Great' => array
			('0' => 'regular'),
	
		'Fredoka One' => array
			('0' => 'regular'),
	
		'Freehand' => array
			('0' => 'regular'),
	
		'Fresca' => array
			('0' => 'regular'),
	
		'Frijole' => array
			('0' => 'regular'),
	
		'Fruktur' => array
			('0' => 'regular'),
	
		'Fugaz One' => array
			('0' => 'regular'),
	
		'GFS Didot' => array
			('0' => 'regular'),
	
		'GFS Neohellenic' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Gabriela' => array
			('0' => 'regular'),
	
		'Gafata' => array
			('0' => 'regular'),
	
		'Galdeano' => array
			('0' => 'regular'),
	
		'Galindo' => array
			('0' => 'regular'),
	
		'Gentium Basic' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Gentium Book Basic' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Geo' => array
			('0' => 'regular','1' => 'italic'),
	
		'Geostar' => array
			('0' => 'regular'),
	
		'Geostar Fill' => array
			('0' => 'regular'),
	
		'Germania One' => array
			('0' => 'regular'),
	
		'Gilda Display' => array
			('0' => 'regular'),
	
		'Give You Glory' => array
			('0' => 'regular'),
	
		'Glass Antiqua' => array
			('0' => 'regular'),
	
		'Glegoo' => array
			('0' => 'regular'),
	
		'Gloria Hallelujah' => array
			('0' => 'regular'),
	
		'Goblin One' => array
			('0' => 'regular'),
	
		'Gochi Hand' => array
			('0' => 'regular'),
	
		'Gorditas' => array
			('0' => 'regular','1' => '700'),
	
		'Goudy Bookletter 1911' => array
			('0' => 'regular'),
	
		'Graduate' => array
			('0' => 'regular'),
	
		'Grand Hotel' => array
			('0' => 'regular'),
	
		'Gravitas One' => array
			('0' => 'regular'),
	
		'Great Vibes' => array
			('0' => 'regular'),
	
		'Griffy' => array
			('0' => 'regular'),
	
		'Gruppo' => array
			('0' => 'regular'),
	
		'Gudea' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Habibi' => array
			('0' => 'regular'),
	
		'Hammersmith One' => array
			('0' => 'regular'),
	
		'Hanalei' => array
			('0' => 'regular'),
	
		'Hanalei Fill' => array
			('0' => 'regular'),
	
		'Handlee' => array
			('0' => 'regular'),
	
		'Hanuman' => array
			('0' => 'regular','1' => '700'),
	
		'Happy Monkey' => array
			('0' => 'regular'),
	
		'Headland One' => array
			('0' => 'regular'),
	
		'Henny Penny' => array
			('0' => 'regular'),
	
		'Herr Von Muellerhoff' => array
			('0' => 'regular'),
	
		'Holtwood One SC' => array
			('0' => 'regular'),
	
		'Homemade Apple' => array
			('0' => 'regular'),
	
		'Homenaje' => array
			('0' => 'regular'),
	
		'IM Fell DW Pica' => array
			('0' => 'regular','1' => 'italic'),
	
		'IM Fell DW Pica SC' => array
			('0' => 'regular'),
	
		'IM Fell Double Pica' => array
			('0' => 'regular','1' => 'italic'),
	
		'IM Fell Double Pica SC' => array
			('0' => 'regular'),
	
		'IM Fell English' => array
			('0' => 'regular','1' => 'italic'),
	
		'IM Fell English SC' => array
			('0' => 'regular'),
	
		'IM Fell French Canon' => array
			('0' => 'regular','1' => 'italic'),
	
		'IM Fell French Canon SC' => array
			('0' => 'regular'),
	
		'IM Fell Great Primer' => array
			('0' => 'regular','1' => 'italic'),
	
		'IM Fell Great Primer SC' => array
			('0' => 'regular'),
	
		'Iceberg' => array
			('0' => 'regular'),
	
		'Iceland' => array
			('0' => 'regular'),
	
		'Imprima' => array
			('0' => 'regular'),
	
		'Inconsolata' => array
			('0' => 'regular','1' => '700'),
	
		'Inder' => array
			('0' => 'regular'),
	
		'Indie Flower' => array
			('0' => 'regular'),
	
		'Inika' => array
			('0' => 'regular','1' => '700'),
	
		'Irish Grover' => array
			('0' => 'regular'),
	
		'Istok Web' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Italiana' => array
			('0' => 'regular'),
	
		'Italianno' => array
			('0' => 'regular'),
	
		'Jacques Francois' => array
			('0' => 'regular'),
	
		'Jacques Francois Shadow' => array
			('0' => 'regular'),
	
		'Jim Nightshade' => array
			('0' => 'regular'),
	
		'Jockey One' => array
			('0' => 'regular'),
	
		'Jolly Lodger' => array
			('0' => 'regular'),
	
		'Josefin Sans' => array
			('0' => '100','1' => '100italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '600','7' => '600italic','8' => '700','9' => '700italic'),
	
		'Josefin Slab' => array
			('0' => '100','1' => '100italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '600','7' => '600italic','8' => '700','9' => '700italic'),
	
		'Joti One' => array
			('0' => 'regular'),
	
		'Judson' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Julee' => array
			('0' => 'regular'),
	
		'Julius Sans One' => array
			('0' => 'regular'),
	
		'Junge' => array
			('0' => 'regular'),
	
		'Jura' => array
			('0' => '300','1' => 'regular','2' => '500','3' => '600'),
	
		'Just Another Hand' => array
			('0' => 'regular'),
	
		'Just Me Again Down Here' => array
			('0' => 'regular'),
	
		'Kameron' => array
			('0' => 'regular','1' => '700'),
	
		'Karla' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Kaushan Script' => array
			('0' => 'regular'),
	
		'Kavoon' => array
			('0' => 'regular'),
	
		'Keania One' => array
			('0' => 'regular'),
	
		'Kelly Slab' => array
			('0' => 'regular'),
	
		'Kenia' => array
			('0' => 'regular'),
	
		'Khmer' => array
			('0' => 'regular'),
	
		'Kite One' => array
			('0' => 'regular'),
	
		'Knewave' => array
			('0' => 'regular'),
	
		'Kotta One' => array
			('0' => 'regular'),
	
		'Koulen' => array
			('0' => 'regular'),
	
		'Kranky' => array
			('0' => 'regular'),
	
		'Kreon' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Kristi' => array
			('0' => 'regular'),
	
		'Krona One' => array
			('0' => 'regular'),
	
		'La Belle Aurore' => array
			('0' => 'regular'),
	
		'Lancelot' => array
			('0' => 'regular'),
	
		'Lato' => array
			('0' => '100','1' => '100italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '700','7' => '700italic','8' => '900','9' => '900italic'),
	
		'League Script' => array
			('0' => 'regular'),
	
		'Leckerli One' => array
			('0' => 'regular'),
	
		'Ledger' => array
			('0' => 'regular'),
	
		'Lekton' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Lemon' => array
			('0' => 'regular'),
	
		'Libre Baskerville' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Life Savers' => array
			('0' => 'regular','1' => '700'),
	
		'Lilita One' => array
			('0' => 'regular'),
	
		'Limelight' => array
			('0' => 'regular'),
	
		'Linden Hill' => array
			('0' => 'regular','1' => 'italic'),
	
		'Lobster' => array
			('0' => 'regular'),
	
		'Lobster Two' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Londrina Outline' => array
			('0' => 'regular'),
	
		'Londrina Shadow' => array
			('0' => 'regular'),
	
		'Londrina Sketch' => array
			('0' => 'regular'),
	
		'Londrina Solid' => array
			('0' => 'regular'),
	
		'Lora' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Love Ya Like A Sister' => array
			('0' => 'regular'),
	
		'Loved by the King' => array
			('0' => 'regular'),
	
		'Lovers Quarrel' => array
			('0' => 'regular'),
	
		'Luckiest Guy' => array
			('0' => 'regular'),
	
		'Lusitana' => array
			('0' => 'regular','1' => '700'),
	
		'Lustria' => array
			('0' => 'regular'),
	
		'Macondo' => array
			('0' => 'regular'),
	
		'Macondo Swash Caps' => array
			('0' => 'regular'),
	
		'Magra' => array
			('0' => 'regular','1' => '700'),
	
		'Maiden Orange' => array
			('0' => 'regular'),
	
		'Mako' => array
			('0' => 'regular'),
	
		'Marcellus' => array
			('0' => 'regular'),
	
		'Marcellus SC' => array
			('0' => 'regular'),
	
		'Marck Script' => array
			('0' => 'regular'),
	
		'Margarine' => array
			('0' => 'regular'),
	
		'Marko One' => array
			('0' => 'regular'),
	
		'Marmelad' => array
			('0' => 'regular'),
	
		'Marvel' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Mate' => array
			('0' => 'regular','1' => 'italic'),
	
		'Mate SC' => array
			('0' => 'regular'),
	
		'Maven Pro' => array
			('0' => 'regular','1' => '500','2' => '700','3' => '900'),
	
		'McLaren' => array
			('0' => 'regular'),
	
		'Meddon' => array
			('0' => 'regular'),
	
		'MedievalSharp' => array
			('0' => 'regular'),
	
		'Medula One' => array
			('0' => 'regular'),
	
		'Megrim' => array
			('0' => 'regular'),
	
		'Meie Script' => array
			('0' => 'regular'),
	
		'Merienda' => array
			('0' => 'regular','1' => '700'),
	
		'Merienda One' => array
			('0' => 'regular'),
	
		'Merriweather' => array
			('0' => '300','1' => 'regular','2' => '700','3' => '900'),
	
		'Merriweather Sans' => array
			('0' => '300','1' => 'regular','2' => '700','3' => '800'),
	
		'Metal' => array
			('0' => 'regular'),
	
		'Metal Mania' => array
			('0' => 'regular'),
	
		'Metamorphous' => array
			('0' => 'regular'),
	
		'Metrophobic' => array
			('0' => 'regular'),
	
		'Michroma' => array
			('0' => 'regular'),
	
		'Milonga' => array
			('0' => 'regular'),
	
		'Miltonian' => array
			('0' => 'regular'),
	
		'Miltonian Tattoo' => array
			('0' => 'regular'),
	
		'Miniver' => array
			('0' => 'regular'),
	
		'Miss Fajardose' => array
			('0' => 'regular'),
	
		'Modern Antiqua' => array
			('0' => 'regular'),
	
		'Molengo' => array
			('0' => 'regular'),
	
		'Molle' => array
			('0' => 'italic'),
	
		'Monda' => array
			('0' => 'regular','1' => '700'),
	
		'Monofett' => array
			('0' => 'regular'),
	
		'Monoton' => array
			('0' => 'regular'),
	
		'Monsieur La Doulaise' => array
			('0' => 'regular'),
	
		'Montaga' => array
			('0' => 'regular'),
	
		'Montez' => array
			('0' => 'regular'),
	
		'Montserrat' => array
			('0' => 'regular','1' => '700'),
	
		'Montserrat Alternates' => array
			('0' => 'regular','1' => '700'),
	
		'Montserrat Subrayada' => array
			('0' => 'regular','1' => '700'),
	
		'Moul' => array
			('0' => 'regular'),
	
		'Moulpali' => array
			('0' => 'regular'),
	
		'Mountains of Christmas' => array
			('0' => 'regular','1' => '700'),
	
		'Mouse Memoirs' => array
			('0' => 'regular'),
	
		'Mr Bedfort' => array
			('0' => 'regular'),
	
		'Mr Dafoe' => array
			('0' => 'regular'),
	
		'Mr De Haviland' => array
			('0' => 'regular'),
	
		'Mrs Saint Delafield' => array
			('0' => 'regular'),
	
		'Mrs Sheppards' => array
			('0' => 'regular'),
	
		'Muli' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic'),
	
		'Mystery Quest' => array
			('0' => 'regular'),
	
		'Neucha' => array
			('0' => 'regular'),
	
		'Neuton' => array
			('0' => '200','1' => '300','2' => 'regular','3' => 'italic','4' => '700','5' => '800'),
	
		'New Rocker' => array
			('0' => 'regular'),
	
		'News Cycle' => array
			('0' => 'regular','1' => '700'),
	
		'Niconne' => array
			('0' => 'regular'),
	
		'Nixie One' => array
			('0' => 'regular'),
	
		'Nobile' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Nokora' => array
			('0' => 'regular','1' => '700'),
	
		'Norican' => array
			('0' => 'regular'),
	
		'Nosifer' => array
			('0' => 'regular'),
	
		'Nothing You Could Do' => array
			('0' => 'regular'),
	
		'Noticia Text' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Nova Cut' => array
			('0' => 'regular'),
	
		'Nova Flat' => array
			('0' => 'regular'),
	
		'Nova Mono' => array
			('0' => 'regular'),
	
		'Nova Oval' => array
			('0' => 'regular'),
	
		'Nova Round' => array
			('0' => 'regular'),
	
		'Nova Script' => array
			('0' => 'regular'),
	
		'Nova Slim' => array
			('0' => 'regular'),
	
		'Nova Square' => array
			('0' => 'regular'),
	
		'Numans' => array
			('0' => 'regular'),
	
		'Nunito' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Odor Mean Chey' => array
			('0' => 'regular'),
	
		'Offside' => array
			('0' => 'regular'),
	
		'Old Standard TT' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Oldenburg' => array
			('0' => 'regular'),
	
		'Oleo Script' => array
			('0' => 'regular','1' => '700'),
	
		'Oleo Script Swash Caps' => array
			('0' => 'regular','1' => '700'),
	
		'Open Sans' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '600','5' => '600italic','6' => '700','7' => '700italic','8' => '800','9' => '800italic'),
	
		'Open Sans Condensed' => array
			('0' => '300','1' => '300italic','2' => '700'),
	
		'Oranienbaum' => array
			('0' => 'regular'),
	
		'Orbitron' => array
			('0' => 'regular','1' => '500','2' => '700','3' => '900'),
	
		'Oregano' => array
			('0' => 'regular','1' => 'italic'),
	
		'Orienta' => array
			('0' => 'regular'),
	
		'Original Surfer' => array
			('0' => 'regular'),
	
		'Oswald' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Over the Rainbow' => array
			('0' => 'regular'),
	
		'Overlock' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic','4' => '900','5' => '900italic'),
	
		'Overlock SC' => array
			('0' => 'regular'),
	
		'Ovo' => array
			('0' => 'regular'),
	
		'Oxygen' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Oxygen Mono' => array
			('0' => 'regular'),
	
		'PT Mono' => array
			('0' => 'regular'),
	
		'PT Sans' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'PT Sans Caption' => array
			('0' => 'regular','1' => '700'),
	
		'PT Sans Narrow' => array
			('0' => 'regular','1' => '700'),
	
		'PT Serif' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'PT Serif Caption' => array
			('0' => 'regular','1' => 'italic'),
	
		'Pacifico' => array
			('0' => 'regular'),
	
		'Paprika' => array
			('0' => 'regular'),
	
		'Parisienne' => array
			('0' => 'regular'),
	
		'Passero One' => array
			('0' => 'regular'),
	
		'Passion One' => array
			('0' => 'regular','1' => '700','2' => '900'),
	
		'Patrick Hand' => array
			('0' => 'regular'),
	
		'Patrick Hand SC' => array
			('0' => 'regular'),
	
		'Patua One' => array
			('0' => 'regular'),
	
		'Paytone One' => array
			('0' => 'regular'),
	
		'Peralta' => array
			('0' => 'regular'),
	
		'Permanent Marker' => array
			('0' => 'regular'),
	
		'Petit Formal Script' => array
			('0' => 'regular'),
	
		'Petrona' => array
			('0' => 'regular'),
	
		'Philosopher' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Piedra' => array
			('0' => 'regular'),
	
		'Pinyon Script' => array
			('0' => 'regular'),
	
		'Pirata One' => array
			('0' => 'regular'),
	
		'Plaster' => array
			('0' => 'regular'),
	
		'Play' => array
			('0' => 'regular','1' => '700'),
	
		'Playball' => array
			('0' => 'regular'),
	
		'Playfair Display' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic','4' => '900','5' => '900italic'),
	
		'Playfair Display SC' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic','4' => '900','5' => '900italic'),
	
		'Podkova' => array
			('0' => 'regular','1' => '700'),
	
		'Poiret One' => array
			('0' => 'regular'),
	
		'Poller One' => array
			('0' => 'regular'),
	
		'Poly' => array
			('0' => 'regular','1' => 'italic'),
	
		'Pompiere' => array
			('0' => 'regular'),
	
		'Pontano Sans' => array
			('0' => 'regular'),
	
		'Port Lligat Sans' => array
			('0' => 'regular'),
	
		'Port Lligat Slab' => array
			('0' => 'regular'),
	
		'Prata' => array
			('0' => 'regular'),
	
		'Preahvihear' => array
			('0' => 'regular'),
	
		'Press Start 2P' => array
			('0' => 'regular'),
	
		'Princess Sofia' => array
			('0' => 'regular'),
	
		'Prociono' => array
			('0' => 'regular'),
	
		'Prosto One' => array
			('0' => 'regular'),
	
		'Puritan' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Purple Purse' => array
			('0' => 'regular'),
	
		'Quando' => array
			('0' => 'regular'),
	
		'Quantico' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Quattrocento' => array
			('0' => 'regular','1' => '700'),
	
		'Quattrocento Sans' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Questrial' => array
			('0' => 'regular'),
	
		'Quicksand' => array
			('0' => '300','1' => 'regular','2' => '700'),
	
		'Quintessential' => array
			('0' => 'regular'),
	
		'Qwigley' => array
			('0' => 'regular'),
	
		'Racing Sans One' => array
			('0' => 'regular'),
	
		'Radley' => array
			('0' => 'regular','1' => 'italic'),
	
		'Raleway' => array
			('0' => '100','1' => '200','2' => '300','3' => 'regular','4' => '500','5' => '600','6' => '700','7' => '800','8' => '900'),
	
		'Raleway Dots' => array
			('0' => 'regular'),
	
		'Rambla' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Rammetto One' => array
			('0' => 'regular'),
	
		'Ranchers' => array
			('0' => 'regular'),
	
		'Rancho' => array
			('0' => 'regular'),
	
		'Rationale' => array
			('0' => 'regular'),
	
		'Redressed' => array
			('0' => 'regular'),
	
		'Reenie Beanie' => array
			('0' => 'regular'),
	
		'Revalia' => array
			('0' => 'regular'),
	
		'Ribeye' => array
			('0' => 'regular'),
	
		'Ribeye Marrow' => array
			('0' => 'regular'),
	
		'Righteous' => array
			('0' => 'regular'),
	
		'Risque' => array
			('0' => 'regular'),
	
		'Roboto' => array
			('0' => '100','1' => '100italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '500','7' => '500italic','8' => '700','9' => '700italic','10' => '900','11' => '900italic'),
	
		'Roboto Condensed' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '700','5' => '700italic'),
	
		'Rochester' => array
			('0' => 'regular'),
	
		'Rock Salt' => array
			('0' => 'regular'),
	
		'Rokkitt' => array
			('0' => 'regular','1' => '700'),
	
		'Romanesco' => array
			('0' => 'regular'),
	
		'Ropa Sans' => array
			('0' => 'regular','1' => 'italic'),
	
		'Rosario' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Rosarivo' => array
			('0' => 'regular','1' => 'italic'),
	
		'Rouge Script' => array
			('0' => 'regular'),
	
		'Ruda' => array
			('0' => 'regular','1' => '700','2' => '900'),
	
		'Rufina' => array
			('0' => 'regular','1' => '700'),
	
		'Ruge Boogie' => array
			('0' => 'regular'),
	
		'Ruluko' => array
			('0' => 'regular'),
	
		'Rum Raisin' => array
			('0' => 'regular'),
	
		'Ruslan Display' => array
			('0' => 'regular'),
	
		'Russo One' => array
			('0' => 'regular'),
	
		'Ruthie' => array
			('0' => 'regular'),
	
		'Rye' => array
			('0' => 'regular'),
	
		'Sacramento' => array
			('0' => 'regular'),
	
		'Sail' => array
			('0' => 'regular'),
	
		'Salsa' => array
			('0' => 'regular'),
	
		'Sanchez' => array
			('0' => 'regular','1' => 'italic'),
	
		'Sancreek' => array
			('0' => 'regular'),
	
		'Sansita One' => array
			('0' => 'regular'),
	
		'Sarina' => array
			('0' => 'regular'),
	
		'Satisfy' => array
			('0' => 'regular'),
	
		'Scada' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Schoolbell' => array
			('0' => 'regular'),
	
		'Seaweed Script' => array
			('0' => 'regular'),
	
		'Sevillana' => array
			('0' => 'regular'),
	
		'Seymour One' => array
			('0' => 'regular'),
	
		'Shadows Into Light' => array
			('0' => 'regular'),
	
		'Shadows Into Light Two' => array
			('0' => 'regular'),
	
		'Shanti' => array
			('0' => 'regular'),
	
		'Share' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Share Tech' => array
			('0' => 'regular'),
	
		'Share Tech Mono' => array
			('0' => 'regular'),
	
		'Shojumaru' => array
			('0' => 'regular'),
	
		'Short Stack' => array
			('0' => 'regular'),
	
		'Siemreap' => array
			('0' => 'regular'),
	
		'Sigmar One' => array
			('0' => 'regular'),
	
		'Signika' => array
			('0' => '300','1' => 'regular','2' => '600','3' => '700'),
	
		'Signika Negative' => array
			('0' => '300','1' => 'regular','2' => '600','3' => '700'),
	
		'Simonetta' => array
			('0' => 'regular','1' => 'italic','2' => '900','3' => '900italic'),
	
		'Sintony' => array
			('0' => 'regular','1' => '700'),
	
		'Sirin Stencil' => array
			('0' => 'regular'),
	
		'Six Caps' => array
			('0' => 'regular'),
	
		'Skranji' => array
			('0' => 'regular','1' => '700'),
	
		'Slackey' => array
			('0' => 'regular'),
	
		'Smokum' => array
			('0' => 'regular'),
	
		'Smythe' => array
			('0' => 'regular'),
	
		'Sniglet' => array
			('0' => '800'),
	
		'Snippet' => array
			('0' => 'regular'),
	
		'Snowburst One' => array
			('0' => 'regular'),
	
		'Sofadi One' => array
			('0' => 'regular'),
	
		'Sofia' => array
			('0' => 'regular'),
	
		'Sonsie One' => array
			('0' => 'regular'),
	
		'Sorts Mill Goudy' => array
			('0' => 'regular','1' => 'italic'),
	
		'Source Code Pro' => array
			('0' => '200','1' => '300','2' => 'regular','3' => '500','4' => '600','5' => '700','6' => '900'),
	
		'Source Sans Pro' => array
			('0' => '200','1' => '200italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '600','7' => '600italic','8' => '700','9' => '700italic','10' => '900','11' => '900italic'),
	
		'Special Elite' => array
			('0' => 'regular'),
	
		'Spicy Rice' => array
			('0' => 'regular'),
	
		'Spinnaker' => array
			('0' => 'regular'),
	
		'Spirax' => array
			('0' => 'regular'),
	
		'Squada One' => array
			('0' => 'regular'),
	
		'Stalemate' => array
			('0' => 'regular'),
	
		'Stalinist One' => array
			('0' => 'regular'),
	
		'Stardos Stencil' => array
			('0' => 'regular','1' => '700'),
	
		'Stint Ultra Condensed' => array
			('0' => 'regular'),
	
		'Stint Ultra Expanded' => array
			('0' => 'regular'),
	
		'Stoke' => array
			('0' => '300','1' => 'regular'),
	
		'Strait' => array
			('0' => 'regular'),
	
		'Sue Ellen Francisco' => array
			('0' => 'regular'),
	
		'Sunshiney' => array
			('0' => 'regular'),
	
		'Supermercado One' => array
			('0' => 'regular'),
	
		'Suwannaphum' => array
			('0' => 'regular'),
	
		'Swanky and Moo Moo' => array
			('0' => 'regular'),
	
		'Syncopate' => array
			('0' => 'regular','1' => '700'),
	
		'Tangerine' => array
			('0' => 'regular','1' => '700'),
	
		'Taprom' => array
			('0' => 'regular'),
	
		'Tauri' => array
			('0' => 'regular'),
	
		'Telex' => array
			('0' => 'regular'),
	
		'Tenor Sans' => array
			('0' => 'regular'),
	
		'Text Me One' => array
			('0' => 'regular'),
	
		'The Girl Next Door' => array
			('0' => 'regular'),
	
		'Tienne' => array
			('0' => 'regular','1' => '700','2' => '900'),
	
		'Tinos' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Titan One' => array
			('0' => 'regular'),
	
		'Titillium Web' => array
			('0' => '200','1' => '200italic','2' => '300','3' => '300italic','4' => 'regular','5' => 'italic','6' => '600','7' => '600italic','8' => '700','9' => '700italic','10' => '900'),
	
		'Trade Winds' => array
			('0' => 'regular'),
	
		'Trocchi' => array
			('0' => 'regular'),
	
		'Trochut' => array
			('0' => 'regular','1' => 'italic','2' => '700'),
	
		'Trykker' => array
			('0' => 'regular'),
	
		'Tulpen One' => array
			('0' => 'regular'),
	
		'Ubuntu' => array
			('0' => '300','1' => '300italic','2' => 'regular','3' => 'italic','4' => '500','5' => '500italic','6' => '700','7' => '700italic'),
	
		'Ubuntu Condensed' => array
			('0' => 'regular'),
	
		'Ubuntu Mono' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Ultra' => array
			('0' => 'regular'),
	
		'Uncial Antiqua' => array
			('0' => 'regular'),
	
		'Underdog' => array
			('0' => 'regular'),
	
		'Unica One' => array
			('0' => 'regular'),
	
		'UnifrakturCook' => array
			('0' => '700'),
	
		'UnifrakturMaguntia' => array
			('0' => 'regular'),
	
		'Unkempt' => array
			('0' => 'regular','1' => '700'),
	
		'Unlock' => array
			('0' => 'regular'),
	
		'Unna' => array
			('0' => 'regular'),
	
		'VT323' => array
			('0' => 'regular'),
	
		'Vampiro One' => array
			('0' => 'regular'),
	
		'Varela' => array
			('0' => 'regular'),
	
		'Varela Round' => array
			('0' => 'regular'),
	
		'Vast Shadow' => array
			('0' => 'regular'),
	
		'Vibur' => array
			('0' => 'regular'),
	
		'Vidaloka' => array
			('0' => 'regular'),
	
		'Viga' => array
			('0' => 'regular'),
	
		'Voces' => array
			('0' => 'regular'),
	
		'Volkhov' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Vollkorn' => array
			('0' => 'regular','1' => 'italic','2' => '700','3' => '700italic'),
	
		'Voltaire' => array
			('0' => 'regular'),
	
		'Waiting for the Sunrise' => array
			('0' => 'regular'),
	
		'Wallpoet' => array
			('0' => 'regular'),
	
		'Walter Turncoat' => array
			('0' => 'regular'),
	
		'Warnes' => array
			('0' => 'regular'),
	
		'Wellfleet' => array
			('0' => 'regular'),
	
		'Wendy One' => array
			('0' => 'regular'),
	
		'Wire One' => array
			('0' => 'regular'),
	
		'Yanone Kaffeesatz' => array
			('0' => '200','1' => '300','2' => 'regular','3' => '700'),
	
		'Yellowtail' => array
			('0' => 'regular'),
	
		'Yeseva One' => array
			('0' => 'regular'),
	
		'Yesteryear' => array
			('0' => 'regular'),
	
		'Zeyada' => array
			('0' => 'regular'),
	
	);

	update_option('cs_font_list', $font_list_init);
	update_option('cs_font_attribute', $font_atts_int);
}

add_action( 'after_setup_theme', 'cs_theme_setup' );
function cs_theme_setup() {
	global $wpdb;
	/* Add theme-supported features. */
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
 	load_theme_textdomain('Awaken', get_template_directory() . '/languages');
	
	if (!isset($content_width)){
		$content_width = 1170;
	}
	
	$args = array(
		'default-color' => '',
		'flex-width' => true,
		'flex-height' => true,
		'default-image' => '',
	);
	add_theme_support('custom-background', $args);
	
	add_theme_support('custom-header', $args);
	// This theme uses post thumbnails
	add_theme_support('post-thumbnails');
 	// Add default posts and comments RSS feed links to head
	add_theme_support('automatic-feed-links');
	/* Add custom actions. */
 	
	global $pagenow;
	if (!session_id()){ 
		add_action('init', 'session_start');
	}
	if(!get_option('cs_font_list') || !get_option('cs_font_attribute')){
		cs_get_google_init_arrays();
	}
	if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php'){
		
		if(!get_option('cs_theme_options')){
			
			add_action('init', 'cs_activation_data');
		}
		add_action('admin_head', 'cs_activate_widget');
		if(!get_option('cs_theme_options')){
			wp_redirect( admin_url( 'themes.php?page=cs_demo_importer' ) );
		}
		//wp_redirect( admin_url( 'themes.php?page=cs_demo_importer' ) );
	}
 	add_action('admin_enqueue_scripts', 'cs_admin_scripts_enqueue');
	//wp_enqueue_scripts
	add_action('wp_enqueue_scripts', 'cs_front_scripts_enqueue');
	add_action('pre_get_posts', 'cs_get_search_results');

	/* Add custom filters. */
	add_filter('widget_text', 'do_shortcode');
 	
	if( class_exists( 'wp_causes' ) ){ 
		add_filter('edit_user_profile','cs_contact_options',10,1);
		add_filter('show_user_profile','cs_contact_options',10,1);
	}
	add_action('edit_user_profile_update', 'cs_contact_options_save' );
	add_action('personal_options_update', 'cs_contact_options_save' );
	add_filter('user_contactmethods','cs_profile_fields',10,1);
	add_action('wp_login', 'cs_user_login', 10, 2 );
	add_filter('login_message','cs_user_login_message');
	add_filter('the_password_form', 'cs_password_form');
	add_filter('wp_page_menu','cs_add_menuid');
	add_filter('wp_page_menu', 'cs_remove_div');
	add_filter('nav_menu_css_class', 'cs_add_parent_css', 10, 2);
	add_filter('pre_get_posts', 'cs_change_query_vars');
	add_action('init','add_oembed_soundcloud');
	
}

/**
 * Disable admin bar on the frontend of your website
 * for subscribers.
 */
function themeblvd_disable_admin_bar() { 
 //if( ! current_user_can('edit_posts') )
  add_filter('show_admin_bar', '__return_false'); 
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to 
 * WP admin for Subscribers.
 */
/*function themeblvd_redirect_admin(){
 if ( ! current_user_can( 'edit_posts' ) ){
  wp_redirect( site_url() );
  exit;  
 }
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );*/

// tgm class for (internal and WordPress repository) plugin activation start
require_once dirname( __FILE__ ) . '/include/theme-components/cs-activation-plugins/tgm_plugin_activation.php';
add_action( 'tgmpa_register', 'cs_register_required_plugins' );


function cs_register_required_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository
		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revslider',
			'source'   				=> get_stylesheet_directory() . '/include/theme-components/cs-activation-plugins/revslider.zip', 
			'required' 				=> false, 
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name'     				=> 'Causes',
			'slug'     				=> 'wp-causes',
			'source'   				=> get_stylesheet_directory() . '/include/theme-components/cs-activation-plugins/wp-causes.zip', 
			'required' 				=> false, 
			'version' 				=> '',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'CodeStyling Localization',
			'slug' 		=> 'codestyling-localization',
			'required' 	=> false,
		),
		array(
			'name' 		=> 'Woocommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),
		array(
			'name'			=> 'Envato Wordpress Toolkit',
			'slug'			=> 'envato-wordpress-toolkit',
			'source'		=> 'https://github.com/envato/envato-wordpress-toolkit/archive/master.zip',
			'required'		=> false,
		)
	);
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'Awaken';
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'Awaken',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'Awaken' ),
			'menu_title'                       			=> __( 'Install Plugins', 'Awaken' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'Awaken' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'Awaken' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'Awaken' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'Awaken' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'Awaken' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);
	tgmpa( $plugins, $config );
}
// tgm class for (internal and WordPress repository) plugin activation end

//Blog Large,Causes,Causes Detail,Blog Detail ( Resize From 840 x 473 Cropping issue)
add_image_size('cs_media_1', 844, 475, true);

//Project Detail    ======4 x 3======(842 x 632) ( Resize From 840 x 630 Cropping issue)
add_image_size('cs_media_2', 842, 632, true);

//Blog Simple,blog Elite,blog Classic ( Resize From 840 x 473 Cropping issue)
add_image_size('cs_media_3', 840, 333, true);

//blog Medium, blog Medium,blog Small, Blog TimeLine, Blog Simple, Sermons Detail, Sermon listing, cause Medium, Cause Grid, Projects Grid   4 x 3(370 x 278)
add_image_size('cs_media_4', 372, 279, true);

//Blog Grid, Sermon grid, Events, Projects, Fancy   ======16 x 9======(370 x 208)
add_image_size('cs_media_5', 370, 208, true);

//Event Detail, Widgets,blog Clean, Event Timline   100 x 100 use  ======default 300 x 300====== (270 x 270)
add_image_size('cs_media_6', 300, 300, true);

// Function Title
function cs_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'Awaken' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'cs_wp_title', 10, 2 );

//Single files paths
function get_custom_post_type_template($single_template) {
     global $post;
	 $single_path = dirname( __FILE__ );
     if ($post->post_type == 'events') {
          $single_template = $single_path.'/cs-templates/event-styles/single-events.php';
     }
	 
	 if ($post->post_type == 'project') {
          $single_template = $single_path.'/cs-templates/project-styles/single-project.php';
     }
	 
	 if ($post->post_type == 'sermons') {
          $single_template = $single_path.'/cs-templates/sermon-styles/single-sermons.php';
     }
     return $single_template;
}
add_filter( 'single_template', 'get_custom_post_type_template' );

/// Next post link class
function cs_posts_link_next_class($format){
  $format = str_replace('href=', 'class="pix-nextpost" href=', $format);
  return $format;
}
add_filter('next_post_link', 'cs_posts_link_next_class');
/// prev post link class
function cs_posts_link_prev_class($format) {
 $format = str_replace('href=', 'class="pix-prevpost" href=', $format);
  return $format;
}
add_filter('previous_post_link', 'cs_posts_link_prev_class');

// author description custom function
if ( ! function_exists( 'cs_author_description' ) ) {
	function cs_author_description( $type = '' ) {
		global $cs_theme_options;
		?>
<div class="cs-about-author">
  <div class="icon-auther"> <i class="fa fa-user"></i> </div>
  <div class="inner">
    <figure>
    <?php
		$current_user = wp_get_current_user();
		$custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
		$size = 70;
		if(isset($custom_image_url) && $custom_image_url <> '') {
			echo '<img src="'.$custom_image_url.'" class="avatar photo" id="upload_media" width="'.$size.'" height="'.$size.'" alt="'.$current_user->display_name .'" />';
		} else {
		?>
			<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('PixFill_author_bio_avatar_size', 70)); ?> </a>
		<?php 
		}
	?>
    </figure>
    <div class="text">
      <header>
        <h6><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a></h6>
      </header>
      <p> 
	  <?php 	
		$author_meta = get_the_author_meta('description');
		if(strlen($author_meta)>200){
			echo substr($author_meta, 0, 200).'...';
		} else {
			echo cs_allow_special_char($author_meta);
		}
		?>
      </p>
      <?php
		if ( $type == 'show' ){?>
      		<a class="btn-post-view cs-bg-color" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('View All Posts','Awaken');?></a> </div>
     <?php }?>
  </div>
</div>

<?php
	}
}

// tgm class for (internal and WordPress repository) plugin activation end
// stripslashes / htmlspecialchars for theme option save start
function stripslashes_htmlspecialchars($value){
    $value = is_array($value) ? array_map('stripslashes_htmlspecialchars', $value) : stripslashes(htmlspecialchars($value));
    return $value;
}
// stripslashes / htmlspecialchars for theme option save end
//Home Page Services
function cs_services(){
	global $cs_theme_option;
	if(isset($cs_theme_option['varto_services_shortcode']) and $cs_theme_option['varto_services_shortcode'] <> ""){ ?>
<div class="parallax-fullwidth services-container">
  <div class="container">
    <?php if($cs_theme_option['varto_sevices_title'] <> ""){ ?>
    <header class="cs-heading-title">
      <h2 class="cs-section-title"><?php echo cs_allow_special_char($cs_theme_option['varto_sevices_title']); ?></h2>
    </header>
    <?php }
			echo do_shortcode($cs_theme_option['varto_services_shortcode']);
	?>
  </div>
</div>
<div class="clear"></div>
<?php
    }
	 
}

//Countries Array

function cs_get_countries() {

    $get_countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan",

        "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands",

        "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China",

        "Colombia", "Comoros", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic People's Republic of Korea", "Democratic Republic of the Congo", "Denmark", "Djibouti",

        "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "England", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Fiji", "Finland", "France", "French Polynesia",

        "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong",

        "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kosovo", "Kuwait", "Kyrgyzstan",

        "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia",

        "Maldives", "Mali", "Malta", "Marshall Islands", "Mauritania", "Mauritius", "Mauritius", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique",

        "Myanmar(Burma)", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Northern Ireland",

        "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Poland", "Portugal", "Puerto Rico",

        "Qatar", "Republic of the Congo", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa",

        "San Marino", "Saudi Arabia", "Scotland", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa",

        "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor-Leste", "Togo", "Tonga",

        "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay",

        "Uzbekistan", "Vanuatu", "Vatican", "Venezuela", "Vietnam", "Wales", "Yemen", "Zambia", "Zimbabwe");

    return $get_countries;

}

// installing tables on theme activating start
	global $pagenow;

// Admin scripts enqueue

function cs_admin_scripts_enqueue() {
	if (is_admin()) {
    $template_path = get_template_directory_uri().'/include/assets/scripts/media_upload.js';
		wp_enqueue_media();
		wp_enqueue_script('my-upload', $template_path, array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
		wp_enqueue_script('datetimepicker1_js', get_template_directory_uri() . '/include/assets/scripts/jquery_datetimepicker.js', '', '', true);
		wp_enqueue_script('admin_theme-option-fucntion_js', get_template_directory_uri() . '/include/assets/scripts/theme_option_fucntion.js', '', '', true);
		
		wp_enqueue_style('fontawesome_iconpicker_min', get_template_directory_uri() . '/include/assets/css/fontawesome.css');

		wp_enqueue_style('fontawesome_iconpicker', get_template_directory_uri() . '/include/assets/css/fontawesome_iconpicker.css');
		wp_enqueue_script('iconpicker_min_awesome', get_template_directory_uri() . '/include/assets/scripts/fontawesome_iconpicker_min.js');
		
		wp_enqueue_style('custom_wp_admin_style', get_template_directory_uri() . '/include/assets/css/admin_style.css');
		wp_enqueue_script('custom_wp_admin_script', get_template_directory_uri() . '/include/assets/scripts/cs_functions.js');
		
		wp_enqueue_script('custom_page_builder_wp_admin_script', get_template_directory_uri() . '/include/assets/scripts/cs_page_builder_functions.js');
		wp_enqueue_script('bootstrap.min_script', get_template_directory_uri() . '/include/assets/scripts/bootstrap.min.js');
		wp_enqueue_style('wp-color-picker');
		
	}
}

// Backend functionality files
require_once (get_template_directory()  . '/functions-theme.php');
require_once (get_template_directory()  . '/include/page_builder.php');
require_once (get_template_directory()  . '/include/post_meta.php');
require_once (get_template_directory()  . '/include/page_options.php');
require_once (get_template_directory()  . '/include/admin_functions.php');
require_once (get_template_directory()  . '/include/theme-components/cs-importer/theme_importer.php');
//require_once (get_template_directory()  . '/include/theme-components/cs-social-login/cs_social_login.php');
//require_once (get_template_directory()  . '/include/theme-components/cs-social-login/google/cs-google-connect.php');
/* include files for post types*/
require_once (get_template_directory().'/include/theme-components/cs-posttypes/pt_events.php');
require_once (get_template_directory().'/include/theme-components/cs-posttypes/pt_portfolios.php');
require_once (get_template_directory().'/include/theme-components/cs-posttypes/pt_sermons.php');
// Result/Reports listing for Instructors


require_once (get_template_directory()  . '/cs-templates/blog-styles/blog_element.php');
require_once (get_template_directory()  . '/cs-templates/blog-styles/blog_functions.php');
require_once (get_template_directory()  . '/cs-templates/blog-styles/blog_templates.php');

require_once (get_template_directory()  . '/cs-templates/event-styles/event_element.php');
require_once (get_template_directory()  . '/cs-templates/event-styles/event_functions.php');
require_once (get_template_directory()  . '/cs-templates/event-styles/event_templates.php');

require_once (get_template_directory()  . '/include/theme-components/cs-mega-menu/custom_walker.php');
require_once (get_template_directory()  . '/include/theme-components/cs-mega-menu/edit_custom_walker.php');
require_once (get_template_directory()  . '/include/theme-components/cs-mega-menu/menu_functions.php');

require_once (get_template_directory()  . '/include/theme-components/cs-widgets/widgets.php');
require_once (TEMPLATEPATH . '/include/theme-components/cs-widgets/widgets_keys.php');
require_once (get_template_directory()  . '/include/theme-components/cs-header/header_functions.php');

require_once (get_template_directory()  . '/include/shortcodes/shortcode_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/shortcode_functions.php');
require_once (get_template_directory()  . '/include/shortcodes/typography_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/typography_function.php');
require_once (get_template_directory()  . '/include/shortcodes/common_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/common_function.php');
require_once (get_template_directory()  . '/include/shortcodes/media_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/media_function.php');
require_once (get_template_directory()  . '/include/shortcodes/contentblock_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/contentblock_function.php');
require_once (get_template_directory()  . '/include/shortcodes/loops_elements.php');
require_once (get_template_directory()  . '/include/shortcodes/loops_function.php');
require_once (get_template_directory()  . '/cs-templates/project-styles/project_elements.php');
require_once (get_template_directory()  . '/cs-templates/project-styles/project_function.php');
require_once (get_template_directory()  . '/cs-templates/project-styles/project_templates.php');

require_once (get_template_directory()  . '/cs-templates/sermon-styles/sermon_element.php');
require_once (get_template_directory()  . '/cs-templates/sermon-styles/sermon_functions.php');
require_once (get_template_directory()  . '/cs-templates/sermon-styles/sermon_templates.php');
 

require_once (get_template_directory()  . '/include/theme-components/cs-mailchimp/mailchimp.class.php');
require_once (get_template_directory()  . '/include/theme-components/cs-mailchimp/mailchimp_functions.php');
require_once (get_template_directory()  . '/include/theme-components/cs-googlefont/fonts.php');
require_once (get_template_directory()  . '/include/theme-components/cs-googlefont/google_fonts.php');
require_once (get_template_directory()  . '/include/theme_colors.php');
require_once (get_template_directory()  . '/include/shortcodes/class_parse.php');
require_once (get_template_directory()  . '/include/theme-options/theme_options.php');
require_once (get_template_directory()  . '/include/theme-options/theme_options_fields.php');
require_once (get_template_directory()  . '/include/theme-options/theme_options_functions.php');
require_once (get_template_directory()  . '/include/theme-options/theme_options_arrays.php');

/* CONTACT FORM 7 VALIDATION */
require_once (get_template_directory()  . '/include/cf7-custom-validation.php');


/////////////////////////////////

if (current_user_can('administrator')) {
	// Addmin Menu CS Theme Option
	
	if (current_user_can('administrator')) {
		 // Addmin Menu CS Theme Option
		 add_action('admin_menu', 'cs_theme');
		 function cs_theme() {
		  add_theme_page('CS Theme Option', 'CS Theme Option', 'read', 'cs_options_page', 'cs_options_page');
		  add_theme_page( "Import Demo Data" , "Import Demo Data" ,'read', 'cs_demo_importer' , 'cs_demo_importer');
		 }
	}
}
 
 /* save user profile fields*/
function cs_user_login( $user_login, $user ) {
		// Get user meta
		$disabled = get_user_meta( $user->ID, 'user_switch', true );
		// Is the use logging in disabled?
		if ( $disabled == '1' ) {
			// Clear cookies, a.k.a log user out
			wp_clear_auth_cookie();
 			// Build login URL and then redirect
			$login_url = site_url( 'wp-login.php', 'login' );
			$login_url = add_query_arg( 'disabled', '1', urlencode($login_url) );
			wp_redirect( $login_url );
			exit;
	}
}

/* show error message*/
function cs_user_login_message( $message ) {
 	// Show the error message if it seems to be a disabled user
	if ( isset( $_GET['disabled'] ) && $_GET['disabled'] == 1 ) 
		$message =  '<div id="cs_login_error">Account Disable</div>';
	return $message;
}

/* Slider Gallery Redirect */
if ( ! function_exists( 'cs_slider_gallery_template_redirect' ) ) {
	function cs_slider_gallery_template_redirect(){
	
		if ( get_post_type() == "cs_gallery" or get_post_type() == "cs_slider" ) {
	
			global $wp_query;
	
			$wp_query->set_404();
	
			status_header( 404 );
	
			get_template_part( 404 ); exit();
	
		}
	
	}
}

// Enqueue frontend style and scripts
if ( ! function_exists( 'cs_front_scripts_enqueue' ) ) {	
	function cs_front_scripts_enqueue() {
		global $cs_theme_options;
		 if (!is_admin()) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'wp-mediaelement','','','',true);
			wp_enqueue_script( 'wp-playlist' );
			wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/assets/css/bootstrap.css');
			if 	(isset($cs_theme_options['cs_responsive']) && $cs_theme_options['cs_responsive'] == "on") {
				echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">';
				wp_enqueue_style('responsive_css', get_template_directory_uri() . '/assets/css/responsive.css');
			}
			wp_enqueue_style('style_css', get_stylesheet_directory_uri() . '/style.css');
			wp_enqueue_style('widget_css', get_template_directory_uri() . '/assets/css/widget.css');
			wp_enqueue_style('font-awesome_css', get_template_directory_uri() . '/assets/css/font-awesome.css');
			wp_enqueue_script('bootstrap.min_script', get_template_directory_uri() . '/assets/scripts/bootstrap.min.js');
			wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/assets/css/flexslider.css');
			wp_enqueue_style('mediaelementplayer.min_css', get_template_directory_uri() . '/assets/css/mediaelementplayer.min.css');
			wp_enqueue_style('prettyPhoto_css', get_template_directory_uri() . '/assets/css/prettyphoto.css');
			if(isset($cs_theme_options['cs_smooth_scroll']) and $cs_theme_options['cs_smooth_scroll'] == 'on'){
				wp_enqueue_script('jquery_nicescroll', get_template_directory_uri() . '/assets/scripts/jquery.nicescroll.min.js', '', '', true);
			}
 			wp_enqueue_script('functions_js', get_template_directory_uri() . '/assets/scripts/functions.js', '', '', true);
			if ( isset($cs_theme_options['cs_style_rtl']) and $cs_theme_options['cs_style_rtl'] == "on"){
				cs_rtl();
			}
			wp_enqueue_style('cs_woocommerce_css', get_template_directory_uri() . '/assets/css/cs_woocommerce.css');
			
			// Custom MCAN Styles
			wp_enqueue_style('fancybox_css', get_template_directory_uri() . '/assets/css/jquery.fancybox.css');
			
			// Custom MCAN Scripts
			wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/scripts/jquery.fancybox.pack.js', '', '', true);
			wp_enqueue_script('mcan', get_template_directory_uri() . '/assets/scripts/mcan.js', '', '', true);
			
   
		 }
	}
}

// Media element 
if ( ! function_exists( 'cs_media_element' ) ) {
	function cs_media_element(){
		wp_enqueue_style( 'wp-mediaelement','','','',true);
	} 
}

// Portfolio Filters
if ( ! function_exists( 'cs_filterable' ) ) {
	function cs_filterable(){
		wp_enqueue_script('filterable_js', get_template_directory_uri() . '/assets/scripts/filterable.js', '', '', true);
	} 
}

// jplayer script enqueue
function cs_enqueue_jplayer(){
	wp_enqueue_script('jplayer_js', get_template_directory_uri() . '/assets/scripts/jquery.jplayer.min.js', '', '', false);
	wp_enqueue_script('jplayer.playlist.min_js', get_template_directory_uri() . '/assets/scripts/jplayer.playlist.min.js', '0', '', false);
}

//RTL stylesheet enqueue
if ( ! function_exists('cs_rtl') ) {
	function cs_rtl(){
		wp_enqueue_style('rtl_css', get_template_directory_uri() . '/assets/css/rtl.css');	
	}
 }
 if ( ! function_exists('cs_mediaelementplayer_css') ) {
	function cs_mediaelementplayer_css(){
		//wp_enqueue_style('mediaelementplayer.min_css', get_template_directory_uri() . '/assets/css/mediaelementplayer.min.css');	
	}
 }
 

// scroll to fix
function cs_scrolltofix(){
		wp_enqueue_script('sticky_header_js', get_template_directory_uri() . '/assets/scripts/sticky_header.js', '', '', true);
}

// Event Calendar Script
if ( ! function_exists( 'cs_eventcalendar_enqueue' ) ) {
	function cs_eventcalendar_enqueue(){
		wp_enqueue_script('eventcalendarFancy_js', get_template_directory_uri() . '/assets/scripts/jquery.eventCalendar.js', '', '', true);
		wp_enqueue_style('eventcalendarFancy_css', get_template_directory_uri() . '/assets/css/eventCalendar.css');
	}
}
 // Prettyphoto
if ( ! function_exists( 'cs_prettyphoto_enqueue' ) ) {
	function cs_prettyphoto_enqueue(){
		wp_enqueue_script('prettyPhoto_js', get_template_directory_uri() . '/assets/scripts/jquery.prettyphoto.js', '', '', true);
		
	}
}

if ( ! function_exists( 'cs_social_connect' ) ) :
function cs_social_connect(){
	//wp_enqueue_script('socialconnect_js', get_template_directory_uri() . '/include/theme-components/cs-social-login/media/js/cs-connect.js', '', '', true);
	
}
endif;

if ( class_exists( 'woocommerce' ) ){
	require_once( get_template_directory()  .'/include/theme-components/cs-woocommerce/config.php' );
	require_once (get_template_directory()  . '/include/theme-components/cs-woocommerce/product_meta.php');
}



if ( ! function_exists( 'cs_enqueue_validation_script' ) ) {			
	function cs_enqueue_validation_script(){
		wp_enqueue_script('jquery.validate.metadata_js', get_template_directory_uri() . '/include/assets/scripts/jquery_validate_metadata.js', '', '', true);
		wp_enqueue_script('jquery.validate_js', get_template_directory_uri() . '/include/assets/scripts/jquery_validate.js', '', '', true);
	}
}
// Location Search Google map
if ( ! function_exists( 'cs_enqueue_location_gmap_script' ) ) {
	function cs_enqueue_location_gmap_script(){
		wp_enqueue_script('jquery.googleapis_js', 'http://maps.googleapis.com/maps/api/js?sensor=false', '', '', true);
		wp_enqueue_script('jquery.gmaps-latlon-picker_js', get_template_directory_uri() . '/include/assets/scripts/jquery_gmaps_latlon_picker.js', '', '', true);
	}
}
// Flexslider Script
if ( ! function_exists( 'cs_enqueue_flexslider_script' ) ) {
	function cs_enqueue_flexslider_script(){
		wp_enqueue_script('jquery.flexslider-min_js', get_template_directory_uri() . '/assets/scripts/jquery.flexslider.js', '', '', true);
		//wp_enqueue_style('flexslider_css', get_template_directory_uri() . '/assets/css/flexslider.css');
	}
}
// Count Numbers
if ( ! function_exists( 'cs_count_numbers_script' ) ) {
	function cs_count_numbers_script(){
		wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/assets/scripts/waypoints_min.js', '', '', true);
	} 
}
// Skillbar
if ( ! function_exists( 'cs_skillbar_script' ) ) {
	function cs_skillbar_script(){
		wp_enqueue_script('waypoints_js', get_template_directory_uri() . '/assets/scripts/waypoints_min.js', '', '', true);
		wp_enqueue_script('circliful_js', get_template_directory_uri() . '/assets/scripts/jquery_circliful.js', '', '', true);
	} 
}

// Add this enqueue Script
if ( ! function_exists( 'cs_addthis_script_init_method' ) ) {
	function cs_addthis_script_init_method(){
		wp_enqueue_script( 'cs_addthis', 'http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true);
	}
}

// carousel script for related posts
if ( ! function_exists( 'cs_owl_carousel' ) ) {
	function cs_owl_carousel(){
		wp_enqueue_script('owl.carousel_js', get_template_directory_uri() . '/assets/scripts/owl_carousel_min.js', '', '', true);
		wp_enqueue_style('owl.carousel_css', get_template_directory_uri() . '/assets/css/owl.carousel.css');	
	}
}

// Favicon and header code in head tag//
if ( ! function_exists( 'cs_header_settings' ) ) {
	function cs_header_settings() {
		global $cs_theme_options;
		?>
<link rel="shortcut icon" href="<?php echo trim($cs_theme_options['cs_custom_favicon']) ? $cs_theme_options['cs_custom_favicon'] : '#' ; ?>">
<?php  
	}
}

// Favicon and header code in head tag//
if ( ! function_exists( 'cs_footer_settings' ) ) {
	function cs_footer_settings() {
		global $cs_theme_options;
		?>
<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ie8.css" /><![endif]-->
<?php  
		if(isset($cs_theme_options['analytics'])){
			echo htmlspecialchars_decode($cs_theme_options['cs_custom_js']);
		}
	}
}

// search varibales start

function cs_get_search_results($query) {

	if ( !is_admin() and (is_search())) {

		$query->set( 'post_type', array( 'post', 'events', 'project', 'sermons', 'product', 'page', 'causes' ) );

		remove_action( 'pre_get_posts', 'cs_get_search_results' );

	}

}
// password protect post/page

if ( ! function_exists( 'cs_password_form' ) ) {

	function cs_password_form() {

		global $post,$cs_theme_option;

		$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

		$o = '<div class="password_protected">

				<div class="protected-icon"><a href="#"><i class="fa fa-unlock-alt fa-4x"></i></a></div>

				<h3>' . __( "This post is password protected. To view it please enter your password below:",'Awaken' ) . '</h3>';

		$o .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">

					<label><input name="post_password" id="' . $label . '" type="password" size="20" /></label>

					<input class="bgcolr" type="submit" name="Submit" value="'.__("Submit", "Awaken").'" />

				</form>

			</div>';

		return $o;
	}
}
// add menu id
if ( ! function_exists( 'cs_add_menuid' ) ) {
	function cs_add_menuid($ulid) {
	
		return preg_replace('/<ul>/', '<ul id="menus">', $ulid, 1);
	
	}
}
// remove additional div from menu
if ( ! function_exists( 'cs_remove_div' ) ) {
	function cs_remove_div ( $menu ){
	
		return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
	}
}
// add parent class
if ( ! function_exists( 'cs_add_parent_css' ) ) {
	function cs_add_parent_css($classes, $item) {
		global $cs_menu_children;
		if ($cs_menu_children)
			$classes[] = 'parent';
		return $classes;
	}
}
// change the default query variable start
if ( ! function_exists( 'cs_change_query_vars' ) ) {
	function cs_change_query_vars($query) {
	
		if (is_search() || is_home()) {
	
			if (empty($_GET['page_id_all']))
	
				$_GET['page_id_all'] = 1;
	
		   $query->query_vars['paged'] = $_GET['page_id_all'];
	
		   return $query;
	
		}
	}
}
// Filter shortcode in text areas

if ( ! function_exists( 'cs_textarea_filter' ) ) { 

	function cs_textarea_filter($content=''){

		return do_shortcode($content);

	}
}

//	Add Featured/sticky text/icon for sticky posts.

if ( ! function_exists( 'cs_featured' ) ) {

	function cs_featured(){

		if ( is_sticky() ){ ?>
        <span class="featured-post">
          <?php _e('Featured', 'Awaken');?>
        </span>
        <?php

		}
	}
}

// display post page title
if ( ! function_exists( 'cs_post_page_title' ) ) {
	function cs_post_page_title(){
	
		if ( is_author() ) {
	
			global $author;
	
			$userdata = get_userdata($author);
	
			echo __('Author', 'Awaken') . " " . __('Archives', 'Awaken') . ": ".$userdata->display_name;
	
		}elseif ( is_tag() || is_tax('event-tag') || is_tax('product_tag')) {
	
			echo __('Tags', 'Awaken') . " " . __('Archives', 'Awaken') . ": " . single_cat_title( '', false );
	
		}elseif ( is_category() || is_tax('event-category') || is_tax('product_cat') ) {
	
			echo __('Categories', 'Awaken') . " " . __('Archives', 'Awaken') . ": " . single_cat_title( '', false );
	
		}elseif( is_search()){
	
			printf( __( 'Search Results %1$s %2$s', 'Awaken' ), ': ','<span>' . get_search_query() . '</span>' ); 
	
		}elseif ( is_day() ) {
	
			printf( __( 'Daily Archives: %s', 'Awaken' ), '<span>' . get_the_date() . '</span>' );
	
		}elseif ( is_month() ) {
	
			printf( __( 'Monthly Archives: %s', 'Awaken' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'Awaken' ) ) . '</span>' );
	
		}elseif ( is_year() ) {
	
			printf( __( 'Yearly Archives: %s', 'Awaken' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'Awaken' ) ) . '</span>' );
	
		}elseif ( is_404()){
	
			_e( 'Error 404', 'Awaken' );
	
		}elseif(!is_page()){
	
			_e( 'Archives', 'Awaken' );
	
		}
	}
}
// If no content, include the "No posts found" function
if ( ! function_exists( 'fnc_no_result_found' ) ) {
		function fnc_no_result_found(){
		$is_search	= '';
		global $cs_theme_options;
		?>
        <div class="page-no-search">
          <?php
          if( ! is_search() ) :
          ?>
          <header>
            <h5>
             <?php _e('No results found.','Awaken');?>
            </h5>
          </header>
          <aside class="cs-icon"> <i class="fa fa-frown-o"></i> </aside>
          <?php
		  endif;
		  
		  if ( is_home() && current_user_can( 'publish_posts' ) ) : 
			  printf( __( '<p>Ready to publish your first post? <a href="%1$s">Get Started Here</a>.</p>', 'Awaken' ), admin_url( 'post-new.php' ) ); 
			  
		   elseif ( is_search() ) :
			  ?>
              <h1><?php _e('No pages were found containing "'.get_search_query().'"','Awaken'); ?></h1>
			  <div class="suggestions">
				  <h5><?php _e('Suggestions:', 'Awaken'); ?></h5>
				  <ul>
					  <li><?php _e('Make sure all words are spelled correctly', 'Awaken'); ?></li>
					  <li><?php _e('Wildcard searches (using the asterisk *) are not supported', 'Awaken'); ?></li>
					  <li><?php _e('Try more general keywords, especially if you are attempting a name', 'Awaken'); ?></li>
				  </ul>
			  </div>
			  <?php
		   else : 
			  _e( '<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>', 'Awaken' ); 
			  
		  endif; 
            
          if ( is_search() ) : 
              get_search_form();
          endif;
		  
		  ?>
        </div>
	<?php
	}
}
function wps_highlight_results($text){
     if(is_search()){
     $sr = get_query_var('s');
     $keys = explode(" ",$sr);
     $text = preg_replace('/('.implode('|', $keys) .')/iu', ''.$sr.'', $text);
     }
     return $text;
}
add_filter('get_the_excerpt', 'wps_highlight_results');
//add_filter('the_title', 'wps_highlight_results');

// Custom function for next previous posts
if ( ! function_exists( 'px_next_prev_custom_links' ) ) {
	 function px_next_prev_custom_links($post_type = 'events'){
			global $post,$wpdb,$cs_theme_options, $cs_xmlObject;
			$previd = $nextid = '';
			$post_type = get_post_type($post->ID);
			$count_posts = wp_count_posts( "$post_type" )->publish;
			$px_postlist_args = array(
			   'posts_per_page'  => -1,
			   'order'           => 'ASC',
			   'post_type'       => "$post_type",
			); 
			$px_postlist = get_posts( $px_postlist_args );
			$ids = array();
			foreach ($px_postlist as $px_thepost) {
			   $ids[] = $px_thepost->ID;
			}
			$thisindex = array_search($post->ID, $ids);
			if(isset($ids[$thisindex-1])){
				$previd = $ids[$thisindex-1];
			} 
			if(isset($ids[$thisindex+1])){
				$nextid = $ids[$thisindex+1];
			} 
			
			echo '<div class="prev-next-post"><div class="row">';
			if (isset($previd) && !empty($previd) && $previd >=0 ) {
			   ?>
			   <div class="col-md-6">
				<article class="prev">
					 <figure><?php  echo  get_the_post_thumbnail($previd, array(70,70) );?></figure>
					 <div class="text">
					   <h2><a href="<?php echo get_permalink($previd); ?>"><?php echo get_the_title($previd);?></a></h2>
						<a class="fa fa-arrow-circle-left" href="<?php echo get_permalink($previd);?>"></a>
					 </div>
				</article>
			  </div>
		   <?php
			}
	
			if (isset($nextid) && !empty($nextid) ) {
				if (isset($previd) && !empty($previd) && $previd >=0 ) {
					$nextClass	= 'right-btn';
				} else {
					$nextClass	= 'right-btn cs-single-post';
				}
				?>
				<div class="col-md-6">
				  <article class="next">
					<figure> <?php   echo get_the_post_thumbnail($nextid, array(70,70) );?></figure>
					<div class="text">
						<h2> <a href="<?php echo get_permalink($nextid); ?>"><?php echo get_the_title($nextid);?></a></h2>
						<a class="fa fa-arrow-circle-right" href="<?php echo get_permalink($nextid); ?>"></a>
					</div>
				  </article>
			   </div>
			<?php	
			}
			echo '</div></div>';
		 wp_reset_query();
	 }
}

/*	Function to get the events info on calander -- START	*/
add_action('get_header', 'my_filter_head');

  function my_filter_head() {
    remove_action('wp_head', '_admin_bar_bump_cb');
  }

// Get User ID
if ( ! function_exists( 'cs_get_user_id' ) ) {
	function cs_get_user_id() {
		global $current_user;
		get_currentuserinfo();
		return $current_user->ID;
	}
}

// get object array
function cs_ObjecttoArray($obj)
{
	if (is_object($obj)) $obj = (array)$obj;
	if (is_array($obj)) {
		$new = array();
		foreach ($obj as $key => $val) {
			$new[$key] = cs_ObjecttoArray($val);
		}
	} else {
		$new = $obj;
	}

	return $new;
}



// Get Google Fonts
function cs_get_google_fonts() {
    $cs_fonts = array("Abel", "Aclonica", "Acme", "Actor", "Advent Pro", "Aldrich", "Allerta", "Allerta Stencil", "Amaranth", "Andika", "Anonymous Pro", "Antic", "Anton", "Arimo", "Armata", "Asap", "Asul",
        "Basic", "Belleza", "Cabin", "Cabin Condensed", "Cagliostro", "Candal", "Cantarell", "Carme", "Chau Philomene One", "Chivo", "Coda Caption", "Comfortaa", "Convergence", "Cousine", "Cuprum", "Days One",
        "Didact Gothic", "Doppio One", "Dorsa", "Dosis", "Droid Sans", "Droid Sans Mono", "Duru Sans", "Economica", "Electrolize", "Exo", "Federo", "Francois One", "Fresca", "Galdeano", "Geo", "Gudea",
        "Hammersmith One", "Homenaje", "Imprima", "Inconsolata", "Inder", "Istok Web", "Jockey One", "Josefin Sans", "Jura", "Karla", "Krona One", "Lato", "Lekton", "Magra", "Mako", "Marmelad", "Marvel",
        "Maven Pro", "Metrophobic", "Michroma", "Molengo", "Montserrat", "Muli", "News Cycle", "Nobile", "Numans", "Nunito", "Open Sans", "Open Sans Condensed", "Orbitron", "Oswald", "Oxygen", "PT Mono",
        "PT Sans", "PT Sans Caption", "PT Sans Narrow", "Paytone One", "Philosopher", "Play", "Pontano Sans", "Port Lligat Sans", "Puritan", "Quantico", "Quattrocento Sans", "Questrial", "Quicksand", "Rationale",
        "Roboto","Ropa Sans", "Rosario", "Ruda", "Ruluko", "Russo One", "Shanti", "Sigmar One", "Signika", "Signika Negative", "Six Caps", "Snippet", "Spinnaker", "Syncopate", "Telex", "Tenor Sans", "Ubuntu",
        "Ubuntu Condensed", "Ubuntu Mono", "Varela", "Varela Round", "Viga", "Voltaire", "Wire One", "Yanone Kaffeesatz", "Adamina", "Alegreya", "Alegreya SC", "Alice", "Alike", "Alike Angular", "Almendra",
        "Almendra SC", "Amethysta", "Andada", "Antic Didone", "Antic Slab", "Arapey", "Artifika", "Arvo", "Average", "Balthazar", "Belgrano", "Bentham", "Bevan", "Bitter", "Brawler", "Bree Serif", "Buenard",
        "Cambo", "Cantata One", "Cardo", "Caudex", "Copse", "Coustard", "Crete Round", "Crimson Text", "Cutive", "Della Respira", "Droid Serif", "EB Garamond", "Enriqueta", "Esteban", "Fanwood Text", "Fjord One",
        "Gentium Basic", "Gentium Book Basic", "Glegoo", "Goudy Bookletter 1911", "Habibi", "Holtwood One SC", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC",
        "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Inika", "Italiana", "Josefin Slab", "Judson", "Junge",
        "Kameron", "Kotta One", "Kreon", "Ledger", "Linden Hill", "Lora", "Lusitana", "Lustria", "Marko One", "Mate", "Mate SC", "Merriweather", "Montaga", "Neuton", "Noticia Text", "Old Standard TT", "Ovo",
        "PT Serif", "PT Serif Caption", "Petrona", "Playfair Display", "Podkova", "Poly", "Port Lligat Slab", "Prata", "Prociono", "Quattrocento", "Radley", "Rokkitt", "Rosarivo", "Simonetta", "Sorts Mill Goudy",
        "Stoke", "Tienne", "Tinos", "Trocchi", "Trykker", "Ultra", "Unna", "Vidaloka", "Volkhov", "Vollkorn", "Abril Fatface", "Aguafina Script", "Aladin", "Alex Brush", "Alfa Slab One", "Allan", "Allura",
        "Amatic SC", "Annie Use Your Telescope", "Arbutus", "Architects Daughter", "Arizonia", "Asset", "Astloch", "Atomic Age", "Aubrey", "Audiowide", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre",
        "Averia Serif Libre", "Bad Script", "Bangers", "Baumans", "Berkshire Swash", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Black Ops One", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC",
        "Bubblegum Sans", "Buda", "Butcherman", "Butterfly Kids", "Cabin Sketch", "Caesar Dressing", "Calligraffitti", "Carter One", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chelsea Market",
        "Cherry Cream Soda", "Chewy", "Chicle", "Coda", "Codystar", "Coming Soon", "Concert One", "Condiment", "Contrail One", "Cookie", "Corben", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crushed",
        "Damion", "Dancing Script", "Dawning of a New Day", "Delius", "Delius Swash Caps", "Delius Unicase", "Devonshire", "Diplomata", "Diplomata SC", "Dr Sugiyama", "Dynalight", "Eater", "Emblema One",
        "Emilys Candy", "Engagement", "Erica One", "Euphoria Script", "Ewert", "Expletus Sans", "Fascinate", "Fascinate Inline", "Federant", "Felipa", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky",
        "Forum", "Fredericka the Great", "Fredoka One", "Frijole", "Fugaz One", "Geostar", "Geostar Fill", "Germania One", "Give You Glory", "Glass Antiqua", "Gloria Hallelujah", "Goblin One", "Gochi Hand",
        "Gorditas", "Graduate", "Gravitas One", "Great Vibes", "Gruppo", "Handlee", "Happy Monkey", "Henny Penny", "Herr Von Muellerhoff", "Homemade Apple", "Iceberg", "Iceland", "Indie Flower", "Irish Grover",
        "Italianno", "Jim Nightshade", "Jolly Lodger", "Julee", "Just Another Hand", "Just Me Again Down Here", "Kaushan Script", "Kelly Slab", "Kenia", "Knewave", "Kranky", "Kristi", "La Belle Aurore",
        "Lancelot", "League Script", "Leckerli One", "Lemon", "Lilita One", "Limelight", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid",
        "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Macondo", "Macondo Swash Caps", "Maiden Orange", "Marck Script", "Meddon", "MedievalSharp", "Medula One", "Megrim",
        "Merienda One", "Metamorphous", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Monofett", "Monoton", "Monsieur La Doulaise", "Montez", "Mountains of Christmas",
        "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Mystery Quest", "Neucha", "Niconne", "Nixie One", "Norican", "Nosifer", "Nothing You Could Do", "Nova Cut",
        "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Oldenburg", "Oleo Script", "Original Surfer", "Over the Rainbow", "Overlock", "Overlock SC", "Pacifico",
        "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Permanent Marker", "Piedra", "Pinyon Script", "Plaster", "Playball", "Poiret One", "Poller One", "Pompiere", "Press Start 2P",
        "Princess Sofia", "Prosto One", "Qwigley", "Raleway", "Rammetto One", "Rancho", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Rochester", "Rock Salt", "Rouge Script",
        "Ruge Boogie", "Ruslan Display", "Ruthie", "Sail", "Salsa", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Schoolbell", "Seaweed Script", "Sevillana", "Shadows Into Light", "Shadows Into Light Two",
        "Share", "Shojumaru", "Short Stack", "Sirin Stencil", "Slackey", "Smokum", "Smythe", "Sniglet", "Sofia", "Sonsie One", "Special Elite", "Spicy Rice", "Spirax", "Squada One", "Stardos Stencil",
        "Stint Ultra Condensed", "Stint Ultra Expanded", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Swanky and Moo Moo", "Tangerine", "The Girl Next Door", "Titan One", "Trade Winds", "Trochut",
        "Tulpen One", "Uncial Antiqua", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "VT323", "Vast Shadow", "Vibur", "Voces", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat",
        "Wellfleet", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada");
    return $cs_fonts;
}

// enqueue timepicker scripts

function cs_enqueue_timepicker_script(){
	//if(is_admin()){
		wp_enqueue_script('datetimepicker1_js', get_template_directory_uri() . '/include/assets/scripts/jquery_datetimepicker.js', '', '', true);
		wp_enqueue_style('datetimepicker1_css', get_template_directory_uri() . '/include/assets/css/jquery_datetimepicker.css');

	//}
}
add_action('admin_enqueue_scripts', 'my_admin_scripts');

// enqueue admin scripts
function my_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'my_plugin_page') {
        wp_enqueue_media();
        wp_register_script('my-admin-js', WP_PLUGIN_URL.'/my-plugin/my-admin.js', array('jquery'));
        wp_enqueue_script('my-admin-js');
    }
}

// register theme menu
function cs_register_my_menus() {
  register_nav_menus(
	array(
		'main-menu'  => __('Main Menu','Awaken'),
		'footer-menu'  => __('Footer Menu','Awaken'),
		'top-menu'  => __('Top Menu','Awaken')
		
 	)
  );
}
add_action( 'init', 'cs_register_my_menus' );

//  Set Post Veiws Start
if(!function_exists('cs_set_post_views')){
		function cs_set_post_views($postID) {
		 //   $visited = get_transient($key); //get transient and store in variable
			if ( !isset($_COOKIE["cs_count_views".$postID]) ){
				setcookie("cs_count_views".$postID, 'post_view_count', time()+86400);
			   //  set_transient( $key, $value, 60*60*12);
				$count_key = 'cs_count_views';
				$count = get_post_meta($postID, $count_key, true);
				if($count==''){
					$count = 0;
					delete_post_meta($postID, $count_key);
					add_post_meta($postID, $count_key, '0');
				}else{
					$count++;
					update_post_meta($postID, $count_key, $count);
				}
			}
		}
}
//  Set Post Veiws End

//  Get Post Veiws Start
if(!function_exists('cs_get_post_views')){
		function cs_get_post_views($postID){
			$count_key = 'cs_count_views';
			$count = get_post_meta($postID, $count_key, true);
			if($count==''){
				delete_post_meta($postID, $count_key);
				add_post_meta($postID, $count_key, '0');
				return "0 ";
			}
		 return number_format($count);
		}
}

//  Get Post Veiws End

//  Excerpt Default Length 
function cs_custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'cs_custom_excerpt_length' );
// Custom excerpt function 
if ( ! function_exists( 'cs_get_the_excerpt' ) ) { 
	function cs_get_the_excerpt($charlength='255', $readmore = 'true', $readmore_text='Read More') {
		global $post,$cs_theme_option;
		$excerpt = trim(preg_replace('/<a[^>]*>(.*)<\/a>/iU', '', get_the_excerpt()));
		if ( strlen( $excerpt ) > $charlength ) {
/*			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );*/
			if ( $charlength > 0 ) {
				$excerpt	=  substr( $excerpt, 0, $charlength );
			} else {
				$excerpt	=   $excerpt;
			}
			if( $readmore == 'true'){
				$more	= '... <a href="' . get_permalink() . '" class="cs-read-more colr"><i class="fa fa-caret-right"></i>' .$readmore_text . '</a>';
			} else {
				$more	= '...';
			}
			return $excerpt.$more;
			
		} else {
			return $excerpt;
		}
	}
}
/* Excerpt Read More  */
function cs_excerpt_more( $more='...' ) {
 	return '....';
}
add_filter( 'excerpt_more', 'cs_excerpt_more' );

// get events tags list
if ( ! function_exists( 'cs_get_event_tags_list' ) ) { 
		function cs_get_event_tags_list($filter_category = '',$filter_tag  ='',$organizer_filter=''){
			global $post;
			$args = array('posts_per_page'=>-1,'post_type' => 'events','event-category' => $filter_category);
			$project_query = new WP_Query($args);
			$count_post = $project_query->post_count;
			$all_tags_arr	= array();
			while ($project_query->have_posts()) : $project_query->the_post();
				$posttags = get_the_terms($post->ID,'event-tag');
				if ($posttags) {
					foreach($posttags as $tag) {
						$all_tags_arr[] = $tag->name; //USING JUST $tag MAKING $all_tags_arr A MULTI-DIMENSIONAL ARRAY, WHICH DOES WORK WITH array_unique
					}
				}
			endwhile;

			if ( is_array($all_tags_arr) && count($all_tags_arr) > 0 ){ 
				$tags_arr = array_unique($all_tags_arr); //REMOVES DUPLICATES
				foreach( $tags_arr as $tag ):
					$active_class = '';
					$el = get_term_by('name', $tag, 'event-tag');
					$arr[] = '"tag-'.$el->slug.'"';
					if($filter_tag==$el->slug){
						$active_class = "class='active'";
					}
					echo '<a href="?organizer='.$organizer_filter.'&amp;?filter_category='.$filter_category.'&amp;filter-tag='.$el->slug.'" id="taglink-tag-'.$el->slug.'" title="tag-'.$el->slug.'" '.$active_class.' >'.$el->name.'</a>';
				endforeach; 
			}else{
				 _e('<a>No Tags Found.</a>','Awaken');
			}
		}
}

//=====================================================================
// Sermons Tags methods
//=====================================================================
if ( ! function_exists( 'cs_get_sermon_tags_list' ) ) { 
		function cs_get_sermon_tags_list($filter_category = '',$filter_tag  =''){
			global $post;
			$args = array('posts_per_page'=>-1,'post_type' => 'sermons','sermon-category' => $filter_category);
			$project_query = new WP_Query($args);
			$count_post = $project_query->post_count;
			$all_tags_arr	= array();
			while ($project_query->have_posts()) : $project_query->the_post();
				$posttags = get_the_terms($post->ID,'sermon-tag');
				if ($posttags) {
					foreach($posttags as $tag) {
						$all_tags_arr[] = $tag->name; //USING JUST $tag MAKING $all_tags_arr A MULTI-DIMENSIONAL ARRAY, WHICH DOES WORK WITH array_unique
					}
				}
			endwhile;

			if ( is_array($all_tags_arr) && count($all_tags_arr) > 0 ){ 
				$tags_arr = array_unique($all_tags_arr); //REMOVES DUPLICATES
				foreach( $tags_arr as $tag ):
					$active_class = '';
					$el = get_term_by('name', $tag, 'sermon-tag');
					$arr[] = '"tag-'.$el->slug.'"';
					if($filter_tag==$el->slug){
						$active_class = "class='active'";
					}
					echo '<a href="?filter_category='.$filter_category.'&amp;filter-tag='.$el->slug.'" id="taglink-tag-'.$el->slug.'" title="tag-'.$el->slug.'" '.$active_class.' >'.$el->name.'</a>';
				endforeach; 
			}else{
				 _e('<a>No Tags Found.</a>','Awaken');
			}
		}
}

//=====================================================================
// Events filtering methods
//=====================================================================
function cs_get_event_filters($cs_filter_category,$cs_filter_switch,$filter_category,$filter_tag,$userArray,$organizer_filter,$cs_custom_animation){
	 global $post,$cs_theme_options,$cs_counter_node,$wpdb;
	 $nav_count = rand(40, 9999999);
	 if ( isset( $cs_filter_switch ) && $cs_filter_switch == 'Yes') { 
	 ?>
		<!--Sorting Navigation-->
        <div class="col-md-12">
          <nav class="wow filter-nav <?php echo cs_allow_special_char($cs_custom_animation);?>">
            <ul class="cs-filter-menu pull-left">
              <li> <a href="#pager-1<?php echo cs_allow_special_char($nav_count);?>"> <i class="fa fa-filter"></i><?php 
               _e('Filter By','Awaken'); ?>  
               </a> </li>
              <li><a href="#pager-2<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-list"></i><?php 
                   _e('Categories','Awaken');  
              ?></a></li>
              <li><a href="#pager-3<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-tags"></i><?php 
                 _e('Tags','Awaken'); 
              ?></a></li>
              <li><a href="#pager-4<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-user"></i><?php 
                 _e('Organizers','Awaken'); 
              ?></a></li>
            </ul>
            <a href="<?php the_permalink();?>" class="pull-right cs-btnshowall"> <i class="fa fa-check-circle-o"></i>
                <?php   _e('Show All','Awaken'); ?>  
            </a>
            <div id="pager-1<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;"> <a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='asc') { echo 'active';}?>" href="?<?php echo 'organizer='.$organizer_filter.'&amp;sort=asc&amp;filter_category='.$filter_category.'&amp;filter-tag='.$filter_tag; ?>"> <?php    _e('Date Published','Awaken'); ?> </a> <a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='alphabetical') { echo 'active';}?>" href="?<?php echo 'organizer='.$organizer_filter.'&amp;sort=alphabetical&amp;filter_category='.$filter_category.'&amp;filter_tag='.$filter_tag; ?>"> <?php echo _e('Alphabetical','Awaken');?></a></div>
            <div id="pager-2<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php
                $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_filter_category ));
                if( isset($cs_filter_category) && ($cs_filter_category <> "" && $cs_filter_category <> "0")   && isset( $row_cat->term_id )){	
                  $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'event-category', 'hide_empty' => 0));
                ?>
              <a href="?<?php echo 'organizer='.$organizer_filter.'&amp;filter_category='.$filter_category; ?>" class="<?php if(($cs_filter_category == $filter_category)){ echo 'bgcolr';}?>"><?php  _e('All Categories','Awaken');?></a>
              <?php
                }else{
                    $categories = get_categories( array('taxonomy' => 'event-category', 'hide_empty' => 0) );
                }
                foreach ($categories as $category) {
                ?>
              <a href="?<?php echo "organizer=".$organizer_filter."&amp;filter_category=".$category->slug?>" 
                          <?php if($category->slug==$filter_category){echo 'class="active"';}?>> <?php echo cs_allow_special_char($category->cat_name); ?> </a>
              <?php }?>
            </div>
            <div id="pager-3<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php cs_get_event_tags_list ($filter_category,$filter_tag,$organizer_filter); ?>
            </div>
            <div id="pager-4<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php 
                $eventusers = get_users('orderby=nicename');
                if ( isset( $userArray ) && $userArray !='' && is_array( $userArray ) ) {
                    foreach ($eventusers as $user) {
                        if ( in_array( $user->ID,$userArray )) {
                         ?>
                  <a <?php if(isset($_GET['organizer']) && $user->ID ==$_GET['organizer']){echo 'class="active"';}?> href="?<?php echo 'organizer='.$user->ID.'&amp;filter_category='.$filter_category.'&amp;filter_tag='.$filter_tag; ?>"> <?php echo cs_allow_special_char($user->display_name); ?> </a>
                  <?php } }
                    } else {?>
                  <a><?php _e('No Organizer Found.','Awaken'); ?> </a>
                  <?php }?>
            </div>
          </nav>
        </div>
	<!--Sorting Navigation End-->
	<?php 
	} 		
}


//=====================================================================
// Events filtering methods
//=====================================================================
function cs_get_sermon_filters($cs_filter_category,$cs_filter_switch,$filter_category,$filter_tag,$cs_custom_animation){
	 global $post,$cs_theme_options,$cs_counter_node,$wpdb;
	 $nav_count = rand(40, 9999999);
	 if ( isset( $cs_filter_switch ) && $cs_filter_switch == 'yes') { 
	 ?>
		<!--Sorting Navigation-->
        <div class="col-md-12">
          <nav class="wow filter-nav <?php echo cs_allow_special_char($cs_custom_animation);?>">
            <ul class="cs-filter-menu pull-left">
              <li> <a href="#pager-1<?php echo cs_allow_special_char($nav_count);?>"> <i class="fa fa-filter"></i><?php 
               _e('Filter By','Awaken'); ?>  
               </a> </li>
              <li><a href="#pager-2<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-list"></i><?php 
                   _e('Categories','Awaken');  
              ?></a></li>
              <li><a href="#pager-3<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-tags"></i><?php 
                 _e('Tags','Awaken'); 
              ?></a></li>
            </ul>
            <a href="<?php the_permalink();?>" class="pull-right cs-btnshowall"> <i class="fa fa-check-circle-o"></i>
                <?php   _e('Show All','Awaken'); ?>  
            </a>
            <div id="pager-1<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;"> <a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='asc') { echo 'active';}?>" href="?<?php echo 'sort=asc&amp;filter_category='.$filter_category.'&amp;filter-tag='.$filter_tag; ?>"> <?php    _e('Date Published','Awaken'); ?> </a> <a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='alphabetical') { echo 'active';}?>" href="?<?php echo 'sort=alphabetical&amp;filter_category='.$filter_category.'&amp;filter_tag='.$filter_tag; ?>"> <?php echo _e('Alphabetical','Awaken');?></a></div>
            <div id="pager-2<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php
                $row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_filter_category ));
                if( isset($cs_filter_category) && ($cs_filter_category <> "" && $cs_filter_category <> "0")   && isset( $row_cat->term_id )){	
                  $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'sermon-category', 'hide_empty' => 0));
                ?>
              <a href="?<?php echo 'filter_category='.$filter_category; ?>" class="<?php if(($cs_filter_category == $filter_category)){ echo 'bgcolr';}?>"><?php  _e('All Categories','Awaken'); ?></a>
              <?php
                }else{
                    $categories = get_categories( array('taxonomy' => 'sermon-category', 'hide_empty' => 0) );
                }
                foreach ($categories as $category) {
                ?>
              <a href="?<?php echo "filter_category=".$category->slug?>" 
                          <?php if($category->slug==$filter_category){echo 'class="active"';}?>> <?php echo cs_allow_special_char($category->cat_name); ?> </a>
              <?php }?>
            </div>
            <div id="pager-3<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php cs_get_sermon_tags_list ($filter_category,$filter_tag); ?>
            </div>
          </nav>
        </div>
	<!--Sorting Navigation End-->
	<?php 
	} 		
}

//=====================================================================
// Blog filtering methods
//=====================================================================
function cs_get_blog_filters($cs_blog_cat,$author_filter,$filter_category,$filter_tag,$cs_blog_filterable,$cs_custom_animation){
	 global $post,$cs_theme_options,$cs_counter_node,$wpdb;
	 $nav_count = rand(40, 9999999);
	 if ( isset( $cs_blog_filterable ) && $cs_blog_filterable == 'yes') { 
	 
	 ?>
		<!--Sorting Navigation-->
        <div class="col-md-12">
          <nav class="wow filter-nav <?php echo cs_allow_special_char($cs_custom_animation);?>">
            <ul class="cs-filter-menu pull-left">
              <li> <a href="#pager-1<?php echo cs_allow_special_char($nav_count);?>"> <i class="fa fa-filter"></i><?php
               _e('Filter By','Awaken'); ?>  
               </a> </li>
              <li><a href="#pager-2<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-list"></i><?php 
                   _e('Affiliates','Awaken');  
              ?></a></li>
              <li><a href="#pager-3<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-tags"></i><?php 
                 _e('Tags','Awaken'); 
              ?></a></li>
              <li><a href="#pager-4<?php echo cs_allow_special_char($nav_count);?>"><i class="fa fa-user"></i><?php
                 _e('Author','Awaken'); 
              ?></a></li>
            </ul>
            <a href="<?php the_permalink();?>" class="pull-right cs-btnshowall"> <i class="fa fa-check-circle-o"></i> 
                <?php   _e('Show All','Awaken'); ?>  
            </a>
            <div id="pager-1<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;"> 
				<a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='asc') { echo 'active';}?>" 
					href="?<?php echo 'by_author='.$author_filter.'&amp;sort=asc&amp;filter_category='.$filter_category.'&amp;filter-tag='.$filter_tag; ?>"> 
						<?php    _e('Date Published','Awaken'); ?> 
				</a>
				<a class="<?php if(isset($_GET['sort']) and $_GET['sort']=='alphabetical') { echo 'active';}?>" 
					href="?<?php echo 'by_author='.$author_filter.'&amp;sort=alphabetical&amp;filter_category='.$filter_category.'&amp;filter_tag='.$filter_tag; ?>"> 
						<?php echo _e('Alphabetical','Awaken');?> 
					</a> 
			</div>
            <div id="pager-2<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
				<?php
					$row_cat = $wpdb->get_row($wpdb->prepare("SELECT * from $wpdb->terms WHERE slug = %s", $cs_blog_cat ));
					if( isset($cs_blog_cat) && ($cs_blog_cat <> "" && $cs_blog_cat <> "0")   && isset( $row_cat->term_id )){	
					  $categories = get_categories( array('child_of' => "$row_cat->term_id", 'taxonomy' => 'category', 'hide_empty' => 1));
				?>
					<!-- show all categories -->
					<a href="<?php echo $postpermalink; ?>?<?php echo 'by_author='.$author_filter.'&amp;filter_category='.$filter_category; ?>" class="<?php if(($cs_blog_cat == $filter_category)){ echo 'bgcolr';}?>">
						<?php  _e('All Affiliates','Awaken'); ?>
					</a>
				<?php
                }else{
                    $categories = get_categories( array('taxonomy' => 'category', 'hide_empty' => 1) );
                }
				foreach ($categories as $category) {
				?>
					<a href="<?php echo the_permalink(); ?>?<?php echo "by_author=".$author_filter."&amp;filter_category=".$category->slug?>" 
					  <?php if($category->slug==$filter_category){echo 'class="active"';}?>> 
						  <?php echo cs_allow_special_char($category->cat_name); ?> 
					</a>
              <?php 
				}
			  ?>
            </div>
			<!-- filter by tag -->
            <div id="pager-3<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php cs_get_post_tags_list ($filter_category,$filter_tag,$author_filter, $post->ID); ?>
            </div>
			
			<!-- filter by author -->
            <div id="pager-4<?php echo cs_allow_special_char($nav_count);?>" class="filter-pager" style="display: none;">
              <?php 
			  			$user_ids = get_users( array(
							'fields'  => 'all',
							'orderby' => 'post_count',
							'order'   => 'DESC',
							'who'     => 'authors',
						) );
						foreach ( $user_ids as $user ) {
							$post_count = count_user_posts( $user->ID );
							// Move on if user has not published a post (yet).
							if ( $post_count ) {?>
                            	<a <?php if(isset($_GET['by_author']) && $user->ID == $_GET['by_author']){echo 'class="active"';}?> href="?<?php echo 'by_author='.$user->ID.'&amp;filter_category='.$filter_category.'&amp;filter_tag='.$filter_tag; ?>"> <?php echo cs_allow_special_char($user->display_name);?> </a>
					  <?php }
						}
			  		 ?> 
            </div>
          </nav>
        </div>
	<!--Sorting Navigation End-->
	<?php 
	} 		
}


//=====================================================================
// Get Post tags list
//=====================================================================
function cs_get_post_tags_list($filter_category = '', $filter_tag  ='', $author_filter='', $postid=0){
	global $post;
	$args = array('posts_per_page'=>-1,'post_type' => 'post','catgory' => $filter_category);
	$project_query = new WP_Query($args);
    while ($project_query->have_posts()) : $project_query->the_post();
    	$posttags = get_the_terms($post->ID,'post_tag');
		if ($posttags) {
        	foreach($posttags as $tag) {
            	$all_tags_arr[] = $tag->name; //USING JUST $tag MAKING $all_tags_arr A MULTI-DIMENSIONAL ARRAY, WHICH DOES WORK WITH array_unique
            }
        }
    endwhile;
    if ( is_array($all_tags_arr) && count($all_tags_arr) > 0 ): 
 		$tags_arr = array_unique($all_tags_arr); //REMOVES DUPLICATES
 	 	foreach( $tags_arr as $tag ):
			$active_class = '';
       		$el = get_term_by('name', $tag, 'post_tag');
			$arr[] = '"tag-'.$el->slug.'"';
			if($filter_tag==$el->slug){
				$active_class = "class='active'";
			}
   			
			echo '<a href="'. get_permalink($postid) . '?by_author='.$author_filter.'&amp;filter_category='.$filter_category.'&amp;filter-tag='.$el->slug.'" id="taglink-tag-'.$el->slug.'" title="tag-'.$el->slug.'" '.$active_class.' >'.$el->name.'</a>';
	 	endforeach; 
 	endif;
}

function remove_menu_ids () {
   add_filter( 'nav_menu_item_id', '__return_null' );
}
add_action( 'init', 'remove_menu_ids' );
  
// Return Seleced
if(!function_exists('cs_selected')){
	function cs_selected($current,$orignal){
		if($current == $orignal){
			echo 'selected=selected';
		}
	}
}

// page builder element size
if(!function_exists('cs_pb_element_sizes')){
		function cs_pb_element_sizes($size= '100'){
			$element_size = 'element-size-100';
			if(isset($size) && $size == ''){
				$element_size = 'element-size-100';
			} else {
				$element_size = 'element-size-'.$size;
			}
			return $element_size;
		}
}


if ( ! function_exists( 'enable_more_buttons' ) ) {	
	function enable_more_buttons($buttons) {
	
		$buttons[] = 'fontselect';
		$buttons[] = 'fontsizeselect';
		$buttons[] = 'styleselect';
		$buttons[] = 'backcolor';
		$buttons[] = 'newdocument';
		$buttons[] = 'cut';
		$buttons[] = 'copy';
		$buttons[] = 'charmap';
		$buttons[] = 'hr';
		$buttons[] = 'visualaid';
		
		return $buttons;
	}
	add_filter("mce_buttons_3", "enable_more_buttons");
}
add_action( 'init', 'my_deregister_heartbeat', 1 );

function my_deregister_heartbeat() {
	global $pagenow;

	if ( 'post.php' != $pagenow && 'post-new.php' != $pagenow )
		wp_deregister_script('heartbeat');
}

// Like Counter
if ( ! function_exists( 'cs_like_counter' ) ) {
		function cs_like_counter($cs_likes_title=''){
		$cs_like_counter = '';
			  $cs_like_counter = get_post_meta(get_the_id(), "cs_like_counter", true);
			  if ( !isset($cs_like_counter) or empty($cs_like_counter) ) $cs_like_counter = 0;
				  if ( isset($_COOKIE["cs_like_counter".get_the_id()]) ) { ?>
					   <a> <i class="fa fa-heart liked-post"></i><span><?php echo cs_allow_special_char($cs_like_counter.' '.$cs_likes_title); ?></span></a> 
			  <?php 	} else {?>
				<a class="likethis<?php echo get_the_id()?> cs-btnheart cs-btnpopover" id="like_this<?php echo get_the_id()?>"  href="javascript:cs_like_counter('<?php echo get_template_directory_uri()?>',<?php echo get_the_id()?>,'<?php echo cs_allow_special_char($cs_likes_title);?>','<?php echo admin_url('admin-ajax.php');?>')" data-container="body" data-toggle="tooltip" data-placement="top" title="<?php _e('Like This','Awaken'); ?>"><i class="fa fa-heart-o"></i><span><?php echo cs_allow_special_char($cs_like_counter.' '.$cs_likes_title);?></span></a>
				   
				   <a class="likes likethis" id="you_liked<?php echo get_the_id()?>" style="display:none;"><i class="fa fa-heart  liked-post"></i><span class="count-numbers like_counter<?php echo get_the_id()?>"><?php echo cs_allow_special_char($cs_like_counter.' '.$cs_likes_title); ?></span> </a>
				 
				  <div id="loading_div<?php echo get_the_id()?>" style="display:none;"><i class="fa fa-spinner fa-spin"></i></div>
			   <?php }
		}

	//likes counter
	add_action( 'wp_ajax_nopriv_cs_likes_count', 'cs_likes_count' );
	add_action( 'wp_ajax_cs_likes_count', 'cs_likes_count' );
}
// Post like counter
if ( ! function_exists( 'cs_likes_count' ) ) {
		function cs_likes_count() {
			
			$cs_like_counter = get_post_meta( $_POST['post_id'] , "cs_like_counter", true);
					if ( !isset($_COOKIE["cs_like_counter".$_POST['post_id'] ]) ){
						setcookie("cs_like_counter".$_POST['post_id'], 'true', time()+(10 * 365 * 24 * 60 * 60), '/');
						update_post_meta( $_POST['post_id'], 'cs_like_counter', $cs_like_counter+1 );
					}
				$cs_like_counter = get_post_meta($_POST['post_id'], "cs_like_counter", true);
				if ( !isset($cs_like_counter) or empty($cs_like_counter) ) $cs_like_counter = 0;
				echo cs_allow_special_char($cs_like_counter);
				die();
		}
}
//Mailchimp
add_action( 'wp_ajax_nopriv_cs_mailchimp', 'cs_mailchimp' );
add_action( 'wp_ajax_cs_mailchimp', 'cs_mailchimp' );

function cs_mailchimp() {
	
	  global $cs_theme_options,$counter;
	  $mailchimp_key = '';
	  if(isset($cs_theme_options['cs_mailchimp_key'])){ $mailchimp_key= $cs_theme_options['cs_mailchimp_key'];}
	  if(isset($_POST) and !empty($_POST['cs_list_id']) and $mailchimp_key !=''){
		  if($mailchimp_key <> ''){
				$MailChimp = new MailChimp($mailchimp_key);
			}
		$email = $_POST['mc_email'];
		$list_id = $_POST['cs_list_id'];
		$result = $MailChimp->call('lists/subscribe', array(
			'id'                => $list_id,
			'email'             => array('email'=>$email),
			'merge_vars'        => array(),
			'double_optin'      => false,
			'update_existing'   => false,
			'replace_interests' => false,
			'send_welcome'      => true,
		));
		if($result <> ''){
			if(isset($result['status']) and $result['status'] == 'error'){
				echo cs_allow_special_char($result['error']);
			}else{
				echo 'subscribe successfully';
			}
		}
	  }else{
		echo 'please set API key';	 
	  }
	  die();
}
// Add SoundCloud oEmbed
function add_oembed_soundcloud(){
wp_oembed_add_provider( 'http://soundcloud.com/*', 'http://api.soundcloud.com/' );
}
//Mailchimp
/**
 * Add TinyMCE to multiple Textareas (usually in backend).
 */

function cs_wp_editor($id='') {
	?>
	<script type="text/javascript">
		 var fullId	= "<?php echo cs_allow_special_char($id);?>";
		 
		//tinymce.execCommand('mceAddEditor', false, fullId);
		// use wordpress settings
		tinymce.init({
		selector: fullId,
		theme:"modern",
		skin:"lightgray",
		language:"en",
		selector:"#" + fullId,
		resize:"vertical",
		menubar:false,
		wpautop:true,
		indent:false,
		quicktags : "em,strong,link",
		toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink",
		//toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
		tabfocus_elements:":prev,:next",
		body_class:"id post-type-post post-status-publish post-format-standard",
		
		});
		
		//quicktags({id : fullId});
		settings = {
			id : fullId,
			// buttons: 'strong,em,link' 
		}

    	quicktags(settings);
            //init tinymce
         //tinymce.init(tinyMCEPreInit.mceInit[fullId]);
			
		//quicktags({id : fullId});
		/*tinymce.execCommand('mceRemoveEditor', true, fullId);
		var init = tinymce.extend( {}, tinyMCEPreInit.mceInit[ fullId ] );
		try { tinymce.init( init ); } catch(e){}
		
		 tinymce.execCommand( 'mceRemoveEditor', false, fullId );
		 tinymce.execCommand( 'mceAddEditor', false, fullId );
		 
		 quicktags({id : fullId});*/
    </script><?php

}

add_action( 'wp_ajax_cs_select_editor', 'cs_wp_editor' );


//Submit Form
add_action( 'wp_ajax_nopriv_cs_contact_form_submit', 'cs_contact_form_submit' );
add_action( 'wp_ajax_cs_contact_form_submit', 'cs_contact_form_submit' );

//Get attachment id
function cs_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

// Custom File types allowed
add_filter('upload_mimes', 'custom_upload_mimes');

function custom_upload_mimes ( $existing_mimes=array() ) {

	// add the file extension to the array

	$existing_mimes['woff'] = 'mime/type';
	$existing_mimes['ttf']  = 'mime/type';
	$existing_mimes['svg']  = 'mime/type';
	$existing_mimes['eot']  = 'mime/type';

	return $existing_mimes;

}

// Contact form submit ajax
if ( ! function_exists( 'cs_contact_form_submit' ) ) :
	function cs_contact_form_submit() {
		define('WP_USE_THEMES', false);
		$subject = '';
		$cs_contact_error_msg = '';
		$cs_contact_email = '';
		$subject_name = 'Subject';
		foreach ($_REQUEST as $keys=>$values) {
			$$keys = esc_attr($values);
		}
		if(isset($phone) && $phone <> ''){
			$subject_name = 'Phone';
			 $subject = $phone;
		}
		$bloginfo 	= get_bloginfo();
			$subjecteEmail = "(" . $bloginfo . ") Contact Form Received";
			$message = '
				<table width="100%" border="1">
				  <tr>
					<td width="100"><strong>Name:</strong></td>
					<td>'.esc_attr($contact_name).'</td>
				  </tr>
				  <tr>
					<td><strong>Email:</strong></td>
					<td>'.sanitize_email($contact_email).'</td>
				  </tr>
				  <tr>
					<td><strong>'.$subject_name.':</strong></td>
					<td>'.esc_attr($subject).'</td>
				  </tr>
				  <tr>
					<td><strong>Message:</strong></td>
					<td>'.balanceTags($contact_msg, true).'</td>
				  </tr>
				  <tr>
					<td><strong>IP Address:</strong></td>
					<td>'.$_SERVER["REMOTE_ADDR"].'</td>
				  </tr>
				</table>';
			$headers = "From: " . esc_attr($contact_name) . "\r\n";
			$headers .= "Reply-To: " . sanitize_email($contact_email) . "\r\n";
			$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
			$headers .= "MIME-Version: 1.0" . "\r\n";
			$attachments = '';
			
			if(	wp_mail( sanitize_email($cs_contact_email), $subjecteEmail, $message, $headers, $attachments ) ) {
				$json	= array();
				$json['type']    = "success";
				$json['message'] = '<p>'.cs_textarea_filter($cs_contact_succ_msg).'</p>';
			} else {
				$json['type']    = "error";
				$json['message'] = '<p>'.cs_textarea_filter($cs_contact_error_msg).'</p>';
			};
			
		echo json_encode( $json );
		die();	
	}
endif; 
 
// Get user profile picture 
if ( ! function_exists( 'cs_admin_user_profile_picture_ajax' ) ) {
	function cs_admin_user_profile_picture_ajax() {
		$picture_class = $user_id = '';
		if(isset($_POST['picture_class']))  $picture_class = $_POST['picture_class'];
		if(isset($_POST['user_id']))  $user_id = $_POST['user_id'];
		
		$update_meta = update_user_meta($user_id, 'user_avatar_display', '');
		if($update_meta){
			echo get_avatar(get_the_author_meta('user_email',$user_id), apply_filters('PixFill_author_bio_avatar_size', 134));	
		} else {
			echo 'error';	
		}
		exit;
	}
	add_action('wp_ajax_cs_admin_user_profile_picture_ajax', 'cs_admin_user_profile_picture_ajax');
}

// Enqueue Player list js
if( ! function_exists('cs_sermon_audio_player')){
	function cs_sermon_audio_player($playlist=false){
			cs_mediaelementplayer_css();
			//add_action( 'wp_enqueue_scripts', 'cs_mediaelementplayer_css' );
		//wp_enqueue_style('mediaelementplayer.min_css', get_template_directory_uri() . '/assets/css/mediaelementplayer.min.css');
 	?>
		<script>
			/* ---------------------------------------------------------------------------
		   * Video,Audio Function
		   * --------------------------------------------------------------------------- */
		  jQuery(function(){
			jQuery('video,audio').mediaelementplayer({
			  loop: true,
			  shuffle: true,
			  playlist: true,
			  audioHeight: 30,
			  playlistposition: 'bottom',
			  features: ['playlistfeature','playpause', 'current', 'progress', 'duration', 'volume'],
			  keyActions: []
			});
		  });
		</script>
	<?php
	}
}

if ( ! function_exists( 'cs_next_prev_post' ) ) { 
	function cs_next_prev_post(){
	global $post;
	posts_nav_link();
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous )
		return;
	?>
    <aside class="cs-post-sharebtn">
      <?php 
        previous_posts_link( '%link', '<i class="fa fa-angle-left"></i>' );
        next_posts_link( '%link','<i class="fa fa-angle-right"></i>' );
        ?>
    </aside>
    <?php
	}
}
/**
*
*@ Header Positions
*
**/
if ( ! function_exists( 'cs_header_position_settings' ) ) :
	function cs_header_position_settings(){
		 global $cs_xmlObject,$cs_theme_options;
			// header setting start
			if(is_page() || is_single()){
				$header_bg_options		= (isset($cs_xmlObject) and $cs_xmlObject->header_bg_options<>'') ? $cs_xmlObject->header_bg_options: '';
				$cs_rev_slider_id		= (isset($cs_xmlObject) and $cs_xmlObject->cs_rev_slider_id<>'') ? $cs_xmlObject->cs_rev_slider_id: '';
				$cs_header_bg_image		= (isset($cs_xmlObject) and $cs_xmlObject->cs_headerbg_image<>'') ? $cs_xmlObject->cs_headerbg_image: '';
				$cs_header_bg_color		= (isset($cs_xmlObject) and $cs_xmlObject->cs_headerbg_color<>'') ? $cs_xmlObject->cs_headerbg_color: '';
			}else{
				$header_bg_options		= (isset($cs_theme_options['cs_headerbg_options']) and $cs_theme_options['cs_headerbg_options']<>'') ? $cs_theme_options['cs_headerbg_options']: '';
				$cs_rev_slider_id		= (isset($cs_theme_options['cs_headerbg_slider']) and $cs_theme_options['cs_headerbg_slider']<>'') ? $cs_theme_options['cs_headerbg_slider']: '';
				$cs_header_bg_image		= (isset($cs_theme_options['cs_headerbg_image']) and $cs_theme_options['cs_headerbg_image']<>'') ? $cs_theme_options['cs_headerbg_image']: '';
				$cs_header_bg_color		= (isset($cs_theme_options['cs_headerbg_color']) and $cs_theme_options['cs_headerbg_color']<>'') ? $cs_theme_options['cs_headerbg_color']: '';
				
			}
			// header setting end
			if($cs_theme_options['cs_header_position'] =='absolute' and (isset($header_bg_options) and $header_bg_options <> '' and $header_bg_options !='none')){
		?>
		<div class="extra">
		<?php if($header_bg_options == 'cs_bg_image_color'){?>
			<style scoped="scoped">
				#main-header{
					background-image:url('<?php echo esc_url($cs_header_bg_image); ?>');
					background-color:<?php echo esc_attr($cs_header_bg_color); ?>;
					min-height:250px;
				}
			</style>
		<?php }elseif($header_bg_options == 'cs_rev_slider'){
				echo do_shortcode('[rev_slider '.$cs_rev_slider_id.']');
			} 
		?>
		</div>
		<?php }       
	}
endif;
if(class_exists('RevSlider')) {
	class cs_RevSlider extends RevSlider{
		public function getAllSliderAliases(){
			$where = "";
			$response = $this->db->fetch(GlobalsRevSlider::$table_sliders,$where,"id");
			$arrAliases = array();
			$slider_array = array();
			foreach($response as $arrSlider){
				$arrAliases['id'] = $arrSlider["id"];
				$arrAliases['title'] = $arrSlider["title"];
				$arrAliases['alias'] = $arrSlider["alias"];
				$slider_array[] = $arrAliases;
			}
			return($slider_array);
		}	
	}
}

//Woocommerce Cart Count
if ( ! function_exists( 'cs_woocommerce_header_cart' ) ) {
	
	function cs_woocommerce_header_cart() {
	if ( class_exists( 'woocommerce' ) ){
		global $woocommerce;
		echo '<a href="'.esc_url($woocommerce->cart->get_cart_url()).'"><i class="fa fa-shopping-cart"></i>'.__('Cart','Awaken'); 
		?>
        <span class="qnt">
        <?php if($woocommerce->cart->cart_contents_count>0){echo intval($woocommerce->cart->cart_contents_count);} else { _e('0','Awaken');} ?>
        </span> </a>
		<?php
		}
	}
}



// MCAN Contact Form 7 
// send submit to BSD
add_action( 'wpcf7_before_send_mail', 'submit_to_bsd' );

function submit_to_bsd( $cf7 )
{	
	$submission = WPCF7_Submission::get_instance();
	$posted_data = $submission->get_posted_data();
	
	$firstname = $posted_data["first-name"];
	$lastname = $posted_data["last-name"];
	$email = $posted_data["email"];
	$zipcode = $posted_data["zipcode"];
	
	
	function post_to_url($url, $data) {
	   $fields = '';
	   foreach($data as $key => $value) { 
		  $fields .= $key . '=' . $value . '&'; 
	   }
	   rtrim($fields, '&');

	   $post = curl_init();

	   if($post === false)
		{
			die('Failed to create curl object');
		}

	   curl_setopt($post, CURLOPT_URL, $url);
	   curl_setopt($post, CURLOPT_POST, count($data));
	   curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
	   curl_setopt($post, CURLOPT_RETURNTRANSFER, true);

	   $response = curl_exec($post);
	   
	   /*
	   $httpCode = curl_getinfo($post, CURLINFO_HTTP_CODE);

		if ( $httpCode != 200 ){
			echo "Return code is {$httpCode} \n"
				.curl_error($post);
		} else {
			echo "<pre>".htmlspecialchars($response)."</pre>";
		}
*/
	   curl_close($post);
	   
	   file_put_contents("test.txt", "Test " . date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']) . " " . $firstname . " " . $lastname . ", " . $email . ", " . $response);
	
	
	   //echo $response;
	}
	
	$data = array(
	   "firstname" => $firstname,
	   "lastname" => $lastname,
	   "zip" => $zipcode,
	   "email" => $email,
	   "custom-23[0]" => 'MCAN'
	);

	post_to_url("http://mcan.bsd.net/page/sapi/mcan-website", $data);
}

