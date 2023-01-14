create database AuctionWebsite;
use AuctionWebsite;
create table users(
    user_id int(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(32) not null,
    password varchar(255) not null,
    first_name varchar(255) not null,
    family_name varchar(255) not null,
    gender boolean not null,
    date_of_birth date not null,
    email_address varchar(30) not null,
    phone_number bigint(20) not null,
    address varchar(50) not null,
    account_role varchar(20) not null 
); 

insert into users Values(100, 'admin', 'root','admin','admin', 1 ,'1998-11-11','admin',12221112111,'admin','admin');
insert into users Values(null, 'Alan', 'root','Alan','Mick', 1 ,'1998-12-01','ucabz41@ucl.ac.uk',12221665131,'London', 'both');
insert into users Values(null, 'Xingrui', 'root','Bob','Chris', 1 ,'1999-08-08','ucabxg3@ucl.ac.uk',12284312122,'Manchester','both');
insert into users Values(null, 'Christina', 'root','Christina','Jack', 0 ,'1997-6-12','achr2221@126.com',15431112881,'Liverpool', 'both');
insert into users Values(null, 'Jame', 'root','Jame','Ross', 0 ,'2000-3-04','chris2221@163.com',12351112861,'Edinburgh', 'both');
insert into users Values(null, 'Wang', 'root','Wang','Lebron', 1 ,'1969-02-02','wang2221@qq.com',12543112190,'London', 'both');
insert into users Values(null, 'Jackson', 'root','Jackson','Kyrie', 1 ,'1999-12-03','jack2221@163.com',12999112109,'Cambridge', 'both');
insert into users Values(null, 'Waris', 'root','Waris','Hezb', 1 ,'1999-06-05','waris@gmail.com',074473621789,'London', 'seller');
insert into users Values(null, 'Junwei', 'root','Junwei','Zhang', 1 ,'1999-06-05','ucabj41@ucl.ac.uk',12999112109,'Tokyo', 'buyer');


 create table categories(
	category_id int(20) not null PRIMARY key AUTO_INCREMENT,
    category_type varchar(20) not null
 );
 insert into categories Values(1, 'Toys');
 insert into categories Values(null, 'Electronics');
 insert into categories Values(null, 'Books');
 insert into categories Values(null, 'Appliances');
 insert into categories Values(null, 'Fashion');




create table items(
    item_id int(20) not null PRIMARY key AUTO_INCREMENT,
    item_name varchar(255) not null,
	item_description varchar(1000) not null,
    starting_price int(20) not null,
    reserve_price int(20) not null,
	item_category int(20) not null,
    end_date datetime not null,
    bid_count int(5) not null,
    seller_id int(20) not null,
    state varchar(20) not null,
    foreign key (seller_id) references users(user_id),
    foreign key (item_category) references categories(category_id)
);
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price, end_date,bid_count, state)Values(1,1,101,
'● Takara Tomy genuine used beyblades in good condition 
● Includes 25 beyblades: 10 attack beyblades, 10 defence beybaldes and 5 ultra-attack beyblades.' ,
'Beyblade Metal Fight Set',18,20,'2022-12-28 23:59:59',1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price, end_date,bid_count, state)Values(null,1,101,
'● Barbie Dreamhouse Dollhouse Playset with Pool & Slide, Party Room, Elevator, Puppy Area, Lights & Sounds, 75+ Pieces, Gift for 3 to 7 Years.
● Measuring 43 inches tall and 41 inches wide, the fully furnished Barbie Dreamhouse inspires endless imagination with 10 indoor and outdoor play areas, customizable features and 75+ storytelling pieces.',
'Barbie Dreamhouse Dollhouse Playset',50,60,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price, end_date,bid_count, state)Values(null,1,102,
'● Interactive Childrens Globe, Educational Smart Globe for Kids with 2.7 Inch LCD Screen, Toys for Children with Games and Activities, Suitable for 5, 6, 7+ Year Olds.
● Educational learning: Go beyond countries and their capitals with this enhanced kids globe that explores cultures, animals, habitats and more through 5+ hours of BBC videos
● Interactive toy: Tap anywhere using the stylus to hear thousands of facts, interact with unique games and trigger videos that let kids visually experience the world',
'Magic Adventures Globe',50,60,'2022-12-29 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,1,103,
'● This special collectible features the Kael Ngu variant cover art of the No.1 Wolverine (2020) comic book and a Pop! vinyl of the fierce mutant warrior, all pre-packaged in a protective case that can be hung on your wall. Suitable for ages 13+.',
'Funko POP Wolverine Vinyl Figure ',10,15,'2022-12-29 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,1,101,
'● Lego city advent calander edition lego set in new condition. Suitable for ages 8+',
'LEGO City Advent Calendar',10,20,'2022-12-20 23:59:59', 2, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,2,104,
'● 256 GB capacity
● 6.7-inch Super Retina XDR display with ProMotion for a faster, more responsive feel
● Cinematic mode adds shallow depth of field and shifts focus automatically in your videos
● Pro camera system with new 12MP Telephoto, Wide, and Ultra Wide cameras; LiDAR Scanner; 6x optical zoom range; macro photography; Photographic Styles, ProRes video, Smart HDR 4, Night mode, Apple ProRAW, 4K Dolby Vision HDR recording
● 12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording
● A15 Bionic chip for lightning-fast performance ',
'iPhone 13 Pro Max - Sierra Blue',1000,1100,'2022-12-18 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,2,106,
'● 128 GB capacity
● 6.7-inch Super Retina XDR display with ProMotion for a faster, more responsive feel
● Cinematic mode adds shallow depth of field and shifts focus automatically in your videos
● Pro camera system with new 12MP Telephoto, Wide, and Ultra Wide cameras; LiDAR Scanner; 6x optical zoom range; macro photography; Photographic Styles, ProRes video, Smart HDR 4, Night mode, Apple ProRAW, 4K Dolby Vision HDR recording
● 12MP TrueDepth front camera with Night mode, 4K Dolby Vision HDR recording
● A15 Bionic chip for lightning-fast performance
● Up to 28 hours of video playback, the best battery life ever in an iPhone
● Durable design with Ceramic Shield
● Industry-leading IP68 water resistance',
'iPhone 13 Pro Max - Alpine Green',600,700,'2022-12-18 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,2,105,
'● 14-inch, Apple M1 Pro chip with 8‑core CPU and 14‑core GPU, 16GB RAM, 512GB SSD          
● Apple M1 Pro or M1 Max chip for a massive leap in CPU, GPU and machine learning performance
● Up to 10-core CPU delivers up to 3.7x faster performance to fly through pro workflows quicker than ever
● Up to 32-core GPU with up to 13x faster performance for graphics-intensive apps and games
● 16-core Neural Engine for up to 11x faster machine learning performance
● Longer battery life, up to 17 hours
● Up to 64GB of unified memory so everything you do is fast and fluid
● Up to 8TB of superfast SSD storage launches apps and opens files in an instant
● Stunning 14-inch Liquid Retina XDR display with extreme dynamic range and contrast ratio
● 1080p FaceTime HD camera with advanced image signal processor for sharper video calls' ,
'2021 Apple Macbook Pro - Space Grey', 1500,1600,'2022-12-25 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,2,105,
'● 10.9-inch Liquid Retina display with True Tone, P3 wide color, and an antireflective coating
● Apple M1 chip with Neural Engine
● 12MP Wide camera
● 12MP Ultra Wide front camera with Center Stage 
● Up to 256GB of storage
● Available in blue, purple, pink, starlight, and space gray
● Stereo landscape speakers
● Touch ID for secure authentication and Apple Pay
● All-day battery life
● 5G capable' ,
'2022 Apple iPad Air - Purple', 300,400,'2022-12-25 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,2,104,
'● 13 Inch 2-in-1 Tablet PC - Silver - Intel Core i7, 16GB RAM, 256GB SSD - Windows 11 Home
● Our most powerful Pro ever. With up to 27% faster CPU performance and 54% faster graphics performance, Surface Pro 8 will handle it all with 11th Gen Intel Core processors and new Windows 11. Surface Pro 8 is the first consumer laptop-to-tablet PC based on the Intel Evo platform.
● Extend the ultimate desktop experience with Thunderbolt 4 ports. Create your ultimate productivity setup with multiple 4K monitors, keep large creative files on hand with an external hard drive, or create a dream gaming setup with an external GPU.
● Our most advanced display in a Pro. 11% larger, 10.8% higher resolution, 12.5% brighter, individually calibrated and virtually edge-to-edge, immerse yourself in the high-resolution 13” PixelSense Flow touch display. Now with up to 120Hz refresh rate (60hz default) for an even smoother pen experience and more responsive touch' ,
'Microsoft Surface Pro 8 ', 900,1000,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,3,101,
'● A beautiful boxed set containing all seven Harry Potter novels in hardback. These new editions of the classic and internationally bestselling, multi-award-winning series feature instantly pick-up-able new jackets by Jonny Duddle, with huge child appeal, to bring Harry Potter to the next generation of readers',
'Harry Potter Box Set:Complete Collection', 40,50,'2022-12-30 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,3,105,
"● With striking new artwork to celebrate the Roald Dahl 100 celebrations and a keepsake slipcase featuring Quentin Blake's iconic illustrations, this 16-book collection brings together all the classic children's novels from the one and only Roald Dahl. Matilda, Going Solo, The Giraffe And The Pelly And Me, George's Marvellous Medicine, Fantastic Mr Fox, The Magic Finger, Esio Trot, Boy Tales Of Childhood, Charlie And The Great Glass Elevator, The BFG, The Witches, The Twits, Charlie And The Chocolate Factory, James And The Giant Peach, Danny The Champion Of The World, Billy And The Minpins" ,
'Roald Dahl Collection 16 Books Box Set', 20,30,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,3,106,
'● Discover the series behind the global phenomenon and the greatest fantasy epic of the modern age with this seven-book collection                                                                                                                                                                                               ● A Song of Ice and Fire is the inspiration for HBO and Sky’s Game of Thrones, the most-watched TV series of all time
● The box-set includes: A GAME OF THRONES, A CLASH OF KINGS, A STORM OF SWORDS, 1: STEEL AND SNOW, A STORM OF SWORDS, 2: BLOOD AND GOLD, A FEAST FOR CROWS, A DANCE WITH DRAGONS, 1: DREAMS AND DUST, A DANCE WITH DRAGONS, 2: AFTER THE FEAST' ,
'Game of Thrones: A Song of Ice and Fire', 30,40,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,3,102,
'● Shatter Me Series 9 Books Collection Set By Tahereh Mafi (Imagine Me, Find Me, Unravel Me, Unite Me, Restore Me, Defy Me, Shatter Me, Ignite Me, Believe Me) Paperback' ,
'Shatter Me Series 9 Books Collection Set', 30,40,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,3,103,
'● With thousands of images, including photography, art, and memorabilia and two gatefold sequences, the book pays vivid tribute to The Greatest both in and outside of the ring. Original essays and five decades worth of interviews and writing explore the courage, convictions, and extraordinary image-building that made Ali one of the most recognizable and inspirational individuals on the planet, an icon not only as an extraordinary athlete, but also as an impassioned advocate of social justice, interfaith understanding, and peace
● Hardback cover' ,
'Greatest of All Time: A Tribute to Muhammad Ali ', 30,40,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,4,104,
'● 10 kg Load, 1400 rpm, White
● kg mode - weighs the load during the first four minutes and adjusts the length of the programme and the water consumption accordingly
● Rapid wash cycles - 3 cycles under 60 minutes (44, 30 and 14) which ensure that your clothes are thoroughly cleaned in the quickest time possible
● nfc connected - connect via the app on your android smartphone to download additional cycles, start cycles and run diagnostic checks
● Variable spin and temperature - allows you to adjust the spin speed and  temperature on all cycles to suit the load
● Connector type: Water Line and Drain; Installation type: Freestanding
● Dimensions (cm) - H85 x W60 x D58' ,
'Candy Smart Pro CS1410TE Freestanding Washing Machine', 270,300,'2022-12-29 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,4,104,
'● Linen Divan Bed with Deluxe Mattress, Matching Headboard 24" and 2 free Storage drawers (Grey, 4FT Small Double 120cm X 190cm)' ,
'Linen Divan Bed with Deluxe Mattress', 300,350,'2022-12-22', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,4,104,
"● Latte & Cappuccino Coffee Maker with Integrated Bean Grinder & Steam Wand | 2.8 L Water Tank | 15 Bar Italian Pump | Stainless Steel
● What's Included - 1 x Barista Max Espresso Machine, 1 x 58mm Group Head & Handle, 1 x Tamp, 1 x 500ml Milk Jug, 2 x Single Floor Filters, 2 x Dual Floor Filters, 1 x Cleaning Pin, 1 x Grinder Brush" ,
'Breville Barista Max Espresso Machine', 250,350,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,4,106,
'● Healthy frying with Rapid Air technology - fry with up to 90 Percent less fat
● Open up a world of possibilities: fry, bake, grill, roast and even reheat
● Touch screen with 7 preset programs, which include frozen snacks, fries, meat, fish, chicken drumsticks, cake and even grilled vegetables                                                                    ● Keep warm function, which keeps your food at the ideal temperature for up to 30 minutes
● Delicious Airfryer recipes for healthy living every day via NutriU App
● Daily inspiration for new recipes based on your preferences' ,
'Philips Essential Air Fryer', 100,120,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,4,105,
"● Mini in size, mighty in power: Powerful 350 W mini blender smoothie maker with 2 speed settings
● Compact modern design: Fits neatly onto your kitchen counter with a 1-litre jug gives 0.6L capacity for convenient use
●  What's in the box: Small blender, dishwasher-safe plastic jug, travel cup" ,
'Philips Mini Blender and Smoothie Maker', 25,30,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,5,104,
'● This stylish urban piece is similar to the Chateau parka but is slightly longer for greater leg protection. With a storm flap over the centre front zipper and two interior pockets, Langford offers clean lines and a modern look - all in an uncompromisingly protective parka
● Size Medium',
'Canada Goose Expedition Mens Parka ', 600,800,'2022-12-24 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,5,106,
'● Part of the Dior Ski Capsule collection, the down jacket combines savoir-faire and technical expertise with couture spirit. Crafted in black CD Diamond Mirage Ski Capsule nylon, it features an insulating technical down and is enhanced by a black Dior signature scratch patch on the sleeve
● Size Large' ,
'Ski Capsule Dior Jacket', 1600,1800,'2022-12-28 23:59:59', 1 , 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,5,103,
'● Saint Laurent leather wallet-on-chain
● 100% calf leather 
● Magnetic closure
● Rectangular shape, detachable chain and leather strap, brand design plaque at flap front, all over quilted, all over grained leather, gold-toned hardware, one main compartment, internal `zip pocket and foiled branding, internal slip pocket and 8 card slots, fully lined
● Height 13cm, width 19cm, depth 4cm, strap length 104cm, strap drop 52cm
● Made in Italy
● Comes with a dust bag, presented in a box' ,
'YSL Monogram Leather Wallet', 500,600,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,5,103,
'● Balenciaga stretch-knit trainers
● 100% fabric
● Slips on
● Round toe, closed toe, sock design, logo detail, ultra-articulated moulded sole unit, ergonomic sole with "No Memory" technology
● Wipe with a clean, dry cloth
● Size 9' ,
'Balenciaga Mens Trainers', 400,500,'2022-12-28 23:59:59', 1, 'active');
insert into items(item_id,item_category,seller_id,item_description,item_name,starting_price,reserve_price,  end_date,bid_count, state)Values(null,5,101,
'● Burberry rubber slides
● Furley Logo-Debossed Rubber Slides
● 100% rubber
● Open-toe, round toe, moulded footbed, branded strap
● Wipe with a clean, dry cloth
● Made in Italy
● Size 7-10' ,
'Burberry Furley Logo-Debossed Rubber Slides', 180,200,'2022-12-28 23:59:59', 1, 'active');




create table bids(
    bid_id int(20) not null PRIMARY key AUTO_INCREMENT,
    bidder_id int(20) not null,
    item_id int(20) not null,
    bid_price int(20) not null,
    createdDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    foreign key (bidder_id) references users(user_id),
    foreign key (item_id) references items(item_id)
    );

    insert into bids Values(1, 101 , 4, 16, null );
    -- insert into bids Values(null, 104 , 23, 650, null );
    -- insert into bids Values(null, 103 , 25, 190, null );
    insert into bids Values(null, 106 , 16, 400, null );
    insert into bids Values(null, 105 , 11, 50, null );
    -- insert into bids Values(null, 106 , 24, 360, null );
    insert into bids Values(null, 102 , 1, 20, null );
    insert into bids Values(null, 105 , 2, 55, null );
    insert into bids Values(null, 101 , 3, 60, null );
    insert into bids Values(null, 102 , 5, 25, null );
    insert into bids Values(null, 101 , 5, 30, null );
    insert into bids Values(null, 103 , 6, 1050, null );
    insert into bids Values(null, 102 , 7, 700, null );
    insert into bids Values(null, 106 , 8, 1500, null );
    insert into bids Values(null, 106 , 9, 550, null );
    insert into bids Values(null, 103 , 10, 950, null );
    insert into bids Values(null, 101 , 12, 30, null );
    insert into bids Values(null, 102 , 13, 45, null );
    insert into bids Values(null, 104 , 14, 35, null );
    insert into bids Values(null, 104 , 15, 40, null );
    insert into bids Values(null, 105 , 17, 370, null );
    insert into bids Values(null, 102 , 18, 360, null );
    insert into bids Values(null, 103 , 19, 130, null );
    insert into bids Values(null, 106 , 20, 40, null );
    insert into bids Values(null, 101 , 21, 845, null );
    insert into bids Values(null, 102 , 22, 1700, null );



create table orders(
    order_id int(20) not null PRIMARY key AUTO_INCREMENT,
    winner_id int(20) not null,
    item_id int(20) not null,
    final_bid_price int(20) not null,
    foreign key (winner_id) references users(user_id),
    foreign key (item_id) references items(item_id)
    );

 
    insert into orders Values(null, 104 , 23, 650 );
    insert into orders Values(null, 106 , 24, 360 );
    insert into orders Values(null, 103 , 25, 190 );

    


create table watchlist(
	user_id int(20) not null,
    item_id int(20) not null,
    foreign key (user_id) references users(user_id),
    foreign key (item_id) references items(item_id)
);

    insert into watchlist Values(101, 6);
    insert into watchlist Values(102, 8);
    insert into watchlist Values(102, 7);
    insert into watchlist Values(106, 21);
