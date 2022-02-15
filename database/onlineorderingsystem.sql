-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2021 at 08:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineorderingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `productID` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `itemsold` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `itemdesc1` varchar(100) NOT NULL,
  `itemdesc2` varchar(100) NOT NULL,
  `itemdesc3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblinventory`
--

INSERT INTO `tblinventory` (`productID`, `photo`, `productName`, `type`, `category`, `subcategory`, `price`, `itemsold`, `quantity`, `itemdesc1`, `itemdesc2`, `itemdesc3`) VALUES
(1, 'abstract leaf print top.jpg', 'Abstract Leaf Print Top ', 'Tops', 'Men', '', 500, 0, 0, 'Front button closure', 'Resort collar neckline', 'Regular fit'),
(2, 'Asymmetric Black white Short sleeved shirt.jpg', 'Asymmetric Black White Short Sleeved Shirt ', 'Tops', 'Men', '', 500, 0, 221, 'Two colored short sleeve shirt', 'Unlined', 'Collar neckline'),
(3, 'Black Kaviar Longline TShirt With Tie Neck.jpg', 'Black Caviar Longline T-Shirt with Tie Neck ', 'Tops', 'Men', '', 375, 0, 197, 'Adjustable round neckline', '100% Cotton', 'Horizontal line embroidered'),
(4, 'casual army cargo top.jpg', 'Casual Army Cargo Top ', 'Tops', 'Men', '', 725, 0, 481, 'Two front flap pockets', 'Unlined', 'Front buttons closure'),
(5, 'Corduroy Stitching Chest Pocket Long Sleeve.jpg', 'Corduroy Stitching Chest Pocket Long Sleeve ', 'Tops', 'Men', '', 800, 0, 333, 'One chest pocket', 'Regular fit', 'Two colored long sleeve shirt'),
(6, 'GUESS St James Striped tshirt.jpg', 'Guess St. James Striped T-Shirt ', 'Tops', 'Men', '', 350, 0, 385, 'Four colored striped tee', 'Centered logoo', 'Crew neckline'),
(7, 'Linen Short Sleeve Shirt.jpg', 'Linen Short Sleeve Shirt ', 'Tops', 'Men', '', 480, 0, 0, 'Breathable and light linen-cotton blend.', 'Short sleeves.', 'Regular fit for a modern'),
(8, 'Navy denim shirt.jpg', 'Navy Denim Shirt ', 'Tops', 'Men', '', 580, 0, 217, 'Front button fastening', 'Collared neckline', 'Two buttoned chest pockets'),
(9, 'PLAID polo shirt.jpg', 'Plaid Polo Shirt', 'Tops', 'Men', '', 500, 0, 374, 'Half button placket', 'Urban Minimalist', 'Textile'),
(10, 'Ralph Lauren polo Stripe Rugby Shirt.jpg', 'Ralph Lauren Polo Stripe Rugby Long sleeve ', 'Tops', 'Men', '', 450, 0, 496, '100% Cotton', 'Collar neckline', 'Striped brand logo'),
(11, 'Space Race Aparaat Navy Blue.jpg', 'Space Race Apparat Navy Blue ', 'Tops', 'Men', '', 300, 0, 288, 'Graphic tee', 'Round neckline', 'Cotton blend'),
(12, 'Striped Breathable Stand Collar Short Sleeve.jpg', 'Striped Breathable Stand Collar Short Sleeve ', 'Tops', 'Men', '', 550, 0, 482, 'Striped mandarin collar shirt', 'Mandarin collar neckline', 'Polyester'),
(13, 'Tape sleeve Camo Tshirt.jpg', 'Tape Sleeve Camo T-Shirt ', 'Tops', 'Men', '', 400, 0, 381, 'Waffle textured camo t-shirt', 'Round neckline', 'Unlined'),
(14, 'Tommy Bahama Long Sleeve Tee.jpg', 'Tommy Bahama Long Sleeve Tee ', 'Tops', 'Men', '', 420, 0, 0, 'Solid tone essential long sleeves tee', 'Crew neckline', 'Cotton'),
(15, 'Tshirt Novelty Cool Tops.jpg', 'Tshirt Novelty Cool Tops', 'Tops', 'Men', '', 300, 0, 279, 'Graphic print short sleeve T-shirt', 'Round neckline', 'Regular fit'),
(16, 'Bill Khaki pants.jpg', 'Bill Khaki Pants ', 'Bottoms', 'Men', '', 799, 0, 248, 'Classic khaki construction', 'A cut inspired by your favorite pair of jeans.', 'Stretch for performance.'),
(17, 'Business CAsual Stretch slim DEsign jeans.jpg', 'Business Casual Stretch Slim Design Jeans ', 'Bottoms', 'Men', '', 530, 0, 365, 'Dark wash denim stretch slim jeans', 'Low rise', 'Zip and button fastening'),
(18, 'CAsual CAlf length short.jpg', 'Casual Calf Length Short ', 'Bottoms', 'Men', '', 499, 0, 478, 'Solid tone casual cargo shorts', 'Mid rise', 'Regular fit'),
(19, 'COTTON ON Oxford Trouser.jpg', 'Cotton On Oxford Trouser ', 'Bottoms', 'Men', '', 600, 0, 0, 'Checkered printed cuffed drawstrings pants', '2 back welt pockets', '2 side pockets'),
(20, 'DICKIES  Slim Taper Flex Olive Pants.jpg', 'Dickies Slim Taper Flex Olive Pants ', 'Bottoms', 'Men', '', 650, 0, 0, 'Solid tone slim tapered pants', 'Five pockets', 'Belt loops'),
(21, 'Disintegration_Cargo_Shorts.jpg', 'Disintegration Cargo Shorts ', 'Bottoms', 'Men', '', 350, 0, 0, 'Solid shade cargo shorts', 'Button & zip fastening', '3-pocket style'),
(22, 'distressed_Dark_Wash_pants.jpg', 'Distressed Dark Wash Pants ', 'Bottoms', 'Men', '', 699, 0, 468, 'Button closure and zip fly', 'Look good, feel comfortable', 'Soft, medium-weight denim'),
(23, 'Drawstring_Waist_Basketball_Shorts.jpg', 'Drawstring Waist Basketball Shorts ', 'Bottoms', 'Men', '', 350, 0, 327, 'Active sports drawstring shorts ', 'Mid rise', 'Elasticized waistband with drawstring fastening'),
(24, 'Empyre Verge Sprint Blue Skinny Jeans.jpg', 'Empyre Verge Sprint Blue Skinny Jeans ', 'Bottoms', 'Men', '', 580, 0, 169, 'Denim jeans with side lining', 'Medium rise', 'Button-fly fastening'),
(25, 'Magic Declaration Upward Street Shorts.jpg', 'Magic Declaration Upward Street Shorts ', 'Bottoms', 'Men', '', 699, 0, 0, 'Fits true to size, take your usual size', 'Solid color cargo shorts with waist drawstring', 'Button and zipper fastening'),
(26, 'Mens Casual Loose Cargo Pants.jpg', 'Men Casual Loose Cargo Pants ', 'Bottoms', 'Men', '', 700, 0, 212, 'Solid shade cargo pants', '8-pocket style', 'Belt loops'),
(27, 'Regular fit trousers in plain virgin wool.jpg', 'Regular Fit Trouser in Plain Virgin Wood ', 'Bottoms', 'Men', '', 949, 0, 136, 'Solid coloured slacks with elastic waist', 'Button and zip fastening with elastic waist', 'Cotton'),
(28, 'Sporty skinny long pants In gray.jpg', 'Sporty Skinny Long Pants in Gray ', 'Bottoms', 'Men', '', 580, 0, 435, 'Button and zip fastening', 'Cotton blend', 'Four pocket design'),
(29, 'Tommy Hilfiger Mens Modern Fit TH Flex Stretch Suit Pants.jpg', 'Tommy Hilfiger Men’s Modern Fit', 'Bottoms', 'Men', '', 999, 0, 288, 'Plain basic slacks', 'Button and zip fastening', 'Workwear'),
(30, 'Under Armour Mens Rival Fleece Jogger Pants Grey.jpg', 'Under Armour Men’s Rival Fleece Jogger Pants Grey ', 'Bottoms', 'Men', '', 650, 0, 0, 'Vertical brand print cuffed jogger pants', 'Regular fit', '2 side pockets'),
(31, 'California Graphic Tee.jpg', 'California Graphic Tee ', 'Tops', 'Women', '', 250, 0, 397, 'Text graphic short sleeve tee', 'Crew neckline', 'Cotton'),
(32, 'Cat Print Cut & Sew Panel Pullover.jpg', 'Cat Print Cut & Sew Panel Pullover ', 'Tops', 'Women', '', 550, 0, 317, '2 colored graphic pullover', 'Round neckline', 'Ribbed hem'),
(33, 'Cats Print Tee.jpg', 'Cats Print Tee ', 'Tops', 'Women', '', 250, 0, 137, 'Graphic print short sleeve T-shirt', 'Unlined', 'Round neckline'),
(34, 'Cut And Sew Panel Drawstring Hoodie.jpg', 'Cut & Sew Panel Drawstring Hoodie ', 'Tops', 'Women', '', 689, 0, 177, 'Best for lifestyle', 'Pullover hoodie', 'Hooded neckline'),
(35, 'Floral Applique Lace Insert Shirt.jpg', 'Floral Applique Lace Insert ', 'Tops', 'Women', '', 600, 0, 413, 'Sheer accented blouse with floral appliques', 'Unlined', 'Turtle neckline'),
(36, 'Floral Print Tie Back Top.jpg', 'Floral Print Tie Back Top ', 'Tops', 'Women', '', 479, 0, 343, '2 colored short sleeves top with ribbon', 'Short sleeves', 'Regular fit'),
(37, 'FULL TILT Texas Eagle Crop Tee.jpg', 'Full Tilt Texas Eagle Crop Tee ', 'Tops', 'Women', '', 230, 0, 0, 'Gray half sleeved crop top ', 'Round neckline', 'Relaxed fit'),
(38, 'Khaki Shift Long Sleeve Chiffon Shirts.jpg', 'Khaki Shift Long Sleeve Chiffon Shirts ', 'Tops', 'Women', '', 630, 0, 110, 'Solid shade batwing sleeve ', 'Collared neckline', 'Front button fastening'),
(39, 'Lapel Plaid Buttons Blouse.jpg', 'Lapel Plaid Buttons Blouse ', 'Tops', 'Women', '', 549, 0, 483, 'Plaid button up top', 'Collared neckline', 'Button up front placket'),
(40, 'Large Uneck chest bow tie with waist and ruffled hem top.jpg', 'Large U Neck Chest Bow Tie with Waist ', 'Tops', 'Women', '', 380, 0, 315, 'Ruffled hem camisole top', 'Square neckline', 'Slip on style'),
(41, 'New Jersey Crop Tee.jpg', 'New Jersey Crop Tee ', 'Tops', 'Women', '', 230, 0, 291, 'Graphic print cropped tee with raw hem', 'Round neckline', 'Oversized fit'),
(42, 'Nope Tshirt sassy nope shirt.jpg', 'Nope T-Shirt Sassy Nope Shirt ', 'Tops', 'Women', '', 250, 0, 378, 'Round neckline', 'Slips on', 'Short sleeves'),
(43, 'Peony Print Bow Tie Front Trumpet Sleeve Blouse.jpg', 'Peony Print Bow Tie ', 'Tops', 'Women', '', 500, 0, 149, 'Floral trumpet top with ruffle details', 'Scoop neckline', 'Quarter sleeves'),
(44, 'Women Asymmetrical Tie Neck Ruffle Trim Top.jpg', 'Women’s Asymmetrical Tie Neck ', 'Tops', 'Women', '', 650, 0, 387, 'Asymmetric neckline', '100% cotton modal', 'Unlined'),
(45, 'Womens Signature Short Sleeve Linen Top.jpg', 'Womens Signature Short Sleeve Linen Top', 'Tops', 'Women', '', 270, 0, 230, 'Striped short sleeves top with ribbon', 'Round neckline', 'Ribbon tie detail'),
(46, 'Asymmetric Flowy Pleated Womens Maxi Skirt.jpg', 'Asymmetric Flowy Pleated Womens Maxi Skirt ', 'Bottoms', 'Women', '', 350, 0, 0, 'Solid color pleated midi skirt', 'High rise', 'Gartered waist'),
(47, 'BDG High Waisted Mom Jean  Light Wash.jpg', 'BDG High Waisted Mom Jean Light Wash ', 'Bottoms', 'Women', '', 300, 0, 487, 'Washed skinny stretch jeans', 'Low rise', 'Fits true to size, take your usual size'),
(48, 'Beige High Waist Button Chic A Line Skirt.jpg', 'Beige High Waist Button Chic A Line Skirt ', 'Bottoms', 'Women', '', 349, 0, 226, 'High rise', 'Elastic waistband', '2 side pockets'),
(49, 'Bershka pocket detail turnup pants in blue.jpg', 'Bershka Pocket Detail Turnup Pants in Blue ', 'Bottoms', 'Women', '', 300, 0, 271, 'Elastic waistband', 'Polyblend', '2 side pockets'),
(50, 'Bershka super high waisted skinny jean in navy blue.jpg', 'Bershka Super High Waisted Skinny Jeans', 'Bottoms', 'Women', '', 375, 0, 449, 'Button and zipper fastening', 'Belt loops', '5 Pockets'),
(51, 'Found The Light Denim Shorts In Mid Wash.jpg', 'Fount the Light Denim Shorts in Mid Wash ', 'Bottoms', 'Women', '', 259, 0, 208, 'Button with zipper fastening', '5 pockets', 'Belt loops'),
(52, 'Frayed Grey Denim Shorts.jpg', 'Frayed Grey Denim Shorts ', 'Bottoms', 'Women', '', 279, 0, 454, 'Stone wash denim shorts with distressed hem', 'Zip and button fastening', '5-pocket design'),
(53, 'Girls A line Kilt Plaid Pleated Skirts.jpg', 'Girl’s A-Line Kilt Plaid Pleated Skirts ', 'Bottoms', 'Women', '', 500, 0, 0, 'Plaid print pleated skirt ', 'Zipper fastening', 'Polyester'),
(54, 'Gray Tied Pocket High Waist Casual Pants.jpg', 'Gray Tied Pocket High Waist', 'Bottoms', 'Women', '', 500, 0, 337, 'High-waisted fit with belt', 'Includes an invisible front zip', 'Cropped at the ankle'),
(55, 'High-waist suits trousers  Women.jpg', 'Women’s High-Waist Suits Trousers ', 'Bottoms', 'Women', '', 370, 0, 0, 'Solid tone straight leg trousers', 'Button and zip fastening', 'Belt loops'),
(56, 'Levis Womens Mile High Super Skinny Jean.jpg', 'Levis Womens Mile Skinny Jeans ', 'Bottoms', 'Women', '', 300, 0, 363, 'Sits below waist', 'Shapes through hip and thigh', 'Mid rise'),
(57, 'Medium High Waisted Straight Leg Jeans.jpg', 'Medium High Waisted Straight Leg Jeans ', 'Bottoms', 'Women', '', 530, 0, 424, 'Zip and button fastening', 'Regular fit', 'High rise'),
(58, 'Red formal pencil skirt.jpg', 'Red Pencil Skirt ', 'Bottoms', 'Women', '', 450, 0, 282, 'Wrap around with front slit', 'Polyester', 'Lined'),
(59, 'Ripped Raw Hem Denim Shorts.jpg', 'Ripped Raw Hem Denim Shorts ', 'Bottoms', 'Women', '', 279, 0, 324, 'Button & zip fastening', '5-pocket style', 'Belt loops'),
(60, 'Vertical-Striped Rolled Hem Pants.jpg', 'Vertical-Striped Rolled Hem Pants ', 'Bottoms', 'Women', '', 500, 0, 113, 'Rolled up hem', 'Straight design', '50% Viscose, 50% Linen'),
(61, 'Asymmetric Cotton Blend Maxi Dress.jpg', 'Asymmetric Cotton Blend Maxi Dress', 'Dress', 'Women', '', 449, 0, 246, 'Off shoulder ruffle trims midi dress', 'Button down fastening', 'Slim fit'),
(62, 'Bodycon Knit Pencil Dress.jpg', 'Bodycon Knit Pencil Dress', 'Dress', 'Women', '', 420, 0, 443, 'Unlined', 'V-neckline', 'Adjustable cami straps'),
(63, 'Burgundy 50s Holiday Party Dress.jpg', 'Burgundy 50s Holiday Party Dress ', 'Dress', 'Women', '', 550, 0, 0, 'Collared neckline', 'Flared fit', 'Unlined'),
(64, 'Button Front Flutter Sleeve Tea Dress.jpg', 'Button Front Flutter Sleeve Tea Dress', 'Dress', 'Women', '', 480, 0, 219, 'Square neckline', 'Button fastening', 'Cotton'),
(65, 'Button Front Polka Dot Ruffle Hem Belted Dress.jpg', 'Button Front Polka Dot Ruffle Hem Belted Dress', 'Dress', 'Women', '', 520, 0, 453, 'V-neckline', 'Unlined', 'Slim fit'),
(66, 'Erika Pink High Neck Long Sleeve Mini Dress.jpg', 'Erika Pink High Neck Long Sleeve Mini Dress', 'Dress', 'Women', '', 680, 0, 423, 'Turtle neckline', 'Long sleeves', 'Polyester blend'),
(67, 'Floral Cut Out Bow Tie Open Back Cami Dress.jpg', 'Floral Cut Out Bow Tie Open Back Cami Dress', 'Dress', 'Women', '', 400, 0, 332, 'Polyester', 'Spaghetti strap style', 'Features an open back'),
(68, 'High Neck Long Sleeve Bag Hip Female Dress.jpg', 'High Neck Long Sleeve Bag Hip Female Dress', 'Dress', 'Women', '', 535, 0, 218, 'Turtle neckline', 'Slip on style', 'Acrylic blend'),
(69, 'J.Crews Party Dress Line.jpg', 'J.Crews Party Dress Line', 'Dress', 'Women', '', 429, 0, 448, 'Sweetheart neckline', 'Padded', 'Slips on'),
(70, 'Josie Ribbon Knit Long Sleeve Dress.jpg', 'Josie Ribbon Knit Long Sleeve Dress', 'Dress', 'Women', '', 535, 0, 306, 'Round neckline', 'Slim fit', 'Long sleeve mini dress with ruffle details'),
(71, 'Sarrana Silk Slip Dress.jpg', 'Sarrana Silk Slip Dress', 'Dress', 'Women', '', 675, 0, 453, 'Notch lapel neckline', 'Satin finish sleeveless mini blazer dress', 'Slim fit'),
(72, 'Short Sleeve High Waist Prints Women Maxi Dress.jpg', 'Short Sleeve High Waist Prints Women Maxi Dress ', 'Dress', 'Women', '', 575, 0, 404, 'Elasticized waistband', 'V-neckline', 'Short sleeves'),
(73, 'Single Breasted Drawstring Waist Pocket Side Dress.jpg', 'Singled Breasted Drawstring Waist Pocket Side Dress ', 'Dress', 'Women', '', 449, 0, 159, 'Square Neckline', 'Back buttons fastening', 'Spaghetti Strap Style'),
(74, 'Valentino classic collar sleeveless dress.jpg', 'Valentino Classic Collar Sleeveless Dress ', 'Dress', 'Women', '', 530, 0, 233, 'Collared neckline', '2 front pockets', 'Sleeveless'),
(75, 'Wrap Dress Womens Belted Backless Side Split.jpg', 'Wrap Dress Womens Belted Backless Side Split ', 'Dress', 'Women', '', 560, 0, 379, 'Solid overlap dress', 'Self-tie ribbon fastening', 'V-neckline'),
(76, 'black stripe pants.jpg', 'Black stripe pants ', 'Bottoms', 'Kids', 'Boys', 325, 0, 209, 'Melange with applique detail shorts', 'Mid rise', 'Stretchable'),
(77, 'brown dungaree pants.jpg', '. Brown Dungaree Pants ', 'Bottoms', 'Kids', 'Boys', 380, 0, 377, 'Boys Basic Twill Pants', 'Belt loops', 'Button and zipper fastening'),
(78, 'chico beige shorts.png', 'Chicco Beige Short ', 'Bottoms', 'Kids', 'Boys', 289, 0, 0, 'Twill fabric', 'Belt loops', 'Elasticized waist band'),
(79, 'brown knee patch dark blue pants.jpg', 'Brown Knee Patch Dark Blue Pants ', 'Bottoms', 'Kids', 'Boys', 340, 0, 500, 'Easy and comfortable to wear', 'Regular fit', 'Casual wear'),
(80, 'black cotton shorts.jpg', '. Black Cotton Short ', 'Bottoms', 'Kids', 'Boys', 260, 0, 182, 'Best for lifestyle', 'Low rise', 'Elastic drawcord waist'),
(81, 'denim blue jogger pants.jpg', 'Denim Blue Jogger Pants ', 'Bottoms', 'Kids', 'Boys', 350, 0, 323, 'Slouchy fleece pants', 'Regular fit', 'Elastic waistband'),
(82, 'sticker print baby blue shorts.jpg', 'Sticker Print Baby Blue Short ', 'Bottoms', 'Kids', 'Boys', 320, 0, 174, 'Elasticized waistband', 'Graphic print rolled hem bermuda shorts', 'Belt loops'),
(83, 'green corduroy pants.jpg', 'Green Corduroy Pants ', 'Bottoms', 'Kids', 'Boys', 375, 0, 429, 'Button fastening', 'Relaxed fit', 'Elastic waistband'),
(84, 'green bermuda shorts.jpg', 'Green Bermuda Short', 'Bottoms', 'Kids', 'Boys', 335, 0, 360, 'Unlined', 'Mid rise', 'Regular fit'),
(85, 'yellow pants.jpg', 'Yellow Pants', 'Bottoms', 'Kids', 'Boys', 350, 0, 336, 'Unlined', 'Elastic waistband ', 'Regular fit'),
(86, 'camo print shorts.jpg', 'Camo print short ', 'Bottoms', 'Kids', 'Boys', 280, 0, 403, 'Camo print cargo shorts with drawstring', 'Mid rise', 'Regular fit'),
(87, 'tie dye jogger jogger pants.jpg', 'Tie Dye Jogger Pants ', 'Bottoms', 'Kids', 'Boys', 310, 0, 361, 'Mid rise', 'Regular fit', 'Drawstring and elasticated waistband fastening'),
(88, 'pac-man print shorts.jpg', 'Pac-man Print Short ', 'Bottoms', 'Kids', 'Boys', 230, 0, 106, 'Mid rise', 'Regular fit', 'Elasticized and drawstring waist'),
(89, 'white cargo pants.jpg', 'White cargo pants ', 'Bottoms', 'Kids', 'Boys', 329, 0, 383, 'Mid rise', 'Zipper fastening', '100% Cotton'),
(90, 'sky blue cargo shorts.jpg', 'Sky Blue Cargo Short ', 'Bottoms', 'Kids', 'Boys', 275, 0, 243, 'Plain cargo shorts', 'Low rise', 'Six pockets'),
(91, 'animal print white shirt.jpg', 'Animal Print White Shirt ', 'Tops', 'Kids', 'Boys', 285, 0, 237, 'Chinese collared neckline', 'All over animal print short sleeve shirt', 'Front flap pocket'),
(92, 'ben10 print orange t-shirt.jpg', 'Ben10 Print Orange T-shirt ', 'Tops', 'Kids', 'Boys', 200, 0, 435, 'Short sleeves', 'Screen-print detail', 'Cotton jersey'),
(93, 'blue and gray stripe  t-shirt.jpg', 'Blue and Gray Stripes T-Shirt', 'Tops', 'Kids', 'Boys', 220, 0, 408, '1 chest pocket ', 'Collared neckline ', 'Button fastening'),
(94, 'boat print dark blue polo.jpg', 'Boat Pink Dark Blue Polo ', 'Tops', 'Kids', 'Boys', 269, 0, 143, 'Collared neckline', 'Printed polo shirt with pocket', 'Cotton'),
(95, 'camo print jacket.jpg', 'Camo Print Jacket ', 'Tops', 'Kids', 'Boys', 325, 0, 230, 'Puff jacket with camo print', 'Hood neckline', 'Zipper fastening'),
(96, 'cardigan jeans long sleeve.jpg', 'Cardigan Jean Blue Long Sleeve', 'Tops', 'Kids', 'Boys', 350, 0, 496, 'Buttoned down polo shirt', '2 front flap pockets ', 'Boys Long sleeve chambray polo shirt'),
(97, 'cat print pink shirt.jpg', 'Cat Print Pink Shirt ', 'Tops', 'Kids', 'Boys', 309, 0, 272, 'Button-up fastening', 'Short sleeves', 'Cotton'),
(98, 'croc print blue polo.jpg', 'Croc Print Blue Polo ', 'Tops', 'Kids', 'Boys', 265, 0, 374, 'All over logo print polo shirt', 'Collared neckline', 'Half button placket'),
(99, 'elbow patch winter jacket.jpg', 'Elbow Patch Winter Jacket ', 'Tops', 'Kids', 'Boys', 370, 0, 331, 'Light tone and comfy inner part', 'Hood neckline', 'Regular fit'),
(100, 'gap yellow jacket.jpeg', 'Gap Yellow Hoodie Jacket ', 'Tops', 'Kids', 'Boys', 380, 0, 280, 'Hood neckline', 'Windbreaker jacket', 'Comfortable to wear'),
(101, 'guitar print white t-shirt.jpeg', 'Guitar Print White T-Shirt ', 'Tops', 'Kids', 'Boys', 200, 0, 335, 'Graphic print short sleeve T-shirt', 'Unlined', 'Crew neckline'),
(102, 'iron man print hoddie jacket.jpg', 'Iron Man Print Hoodie Jacket ', 'Tops', 'Kids', 'Boys', 320, 0, 479, '100% Polyester', 'Zipper fastening', 'Long sleeves'),
(103, 'light blue long sleeve.jpg', 'Light Blue Front Button Long Sleeve ', 'Tops', 'Kids', 'Boys', 285, 0, 427, 'Collared neckline', 'Single breasted pocket', 'Button down fastening'),
(104, 'mint green long sleeve.jpg', 'Mint Green Long Sleeve ', 'Tops', 'Kids', 'Boys', 279, 0, 204, 'Plain colored long sleeve shirt', 'Collared neckline', 'Single breasted pocket'),
(105, 'palm tree print black polo.jpg', 'Palm Tree Print Black Polo ', 'Tops', 'Kids', 'Boys', 299, 0, 434, 'Half button fastening', 'All over tropical and logo print polo shirt', 'Collared neckline'),
(106, 'pink button front long sleeve.jpg', 'Pink Button Front Long Sleeve ', 'Tops', 'Kids', 'Boys', 260, 0, 380, 'Graphic print design long sleeve shirt', 'Collared neckline', 'Regular fit'),
(107, 'polca dark blue longsleeve.jpg', 'Polka Dots Dark Blue Long Sleeve ', 'Tops', 'Kids', 'Boys', 280, 0, 241, 'Graphic print solid toned shirt', 'Button-up fastening', 'Buttoned cuffs long sleeves'),
(108, 'space print gray t-shirt.jpg', 'Space Print Gray T-Shirt ', 'Tops', 'Kids', 'Boys', 200, 0, 204, 'Round neckline', 'Slips on', 'Regular fit'),
(109, 'KB_T17.jpg', 'Black and White Stripes Jacket ', 'Tops', 'Kids', 'Boys', 345, 0, 173, 'Hood neckline', 'Zipper fastening', 'Polyamide'),
(110, 'black and pink letter print top.jpg', 'Black and Pink Letter Print Top ', 'Tops', 'Kids', 'Girls', 280, 0, 186, 'Round neckline', 'Slip on style', 'Organic cotton'),
(111, 'cold shoulder yellowed top.jpg', 'Cold Shoulder Yellow Top ', 'Tops', 'Kids', 'Girls', 250, 0, 378, 'Fits loosely on the body', 'Playful chest ruffles style', 'Flounce sleeves'),
(112, 'dino print gray t-shirt.png', 'Dino Print Gray T-shirt ', 'Tops', 'Kids', 'Girls', 200, 0, 422, 'Graphic print short sleeve shirt', 'Best for lifestyle', 'Round neckline'),
(113, 'floral print pink short sleeve.jpg', 'Floral Print Pink Short Sleeve ', 'Tops', 'Kids', 'Girls', 295, 0, 139, 'Graphic print with ruffle sleeve top', 'Collared neckline', 'Regular fit'),
(114, 'girl = yellow offshoulder strap .jpg', 'Yellow Off Shoulder Strap Top', 'Tops', 'Kids', 'Girls', 250, 0, 423, 'Open-shoulder top ', 'Airy woven fabric', 'Square neckline'),
(115, 'heart and flower print blue top.jpg', 'Heart and Flower Print Blue Top ', 'Tops', 'Women', 'Girls', 220, 0, 490, 'Heart and flower print with ruffle sleeve top', 'Round neckline', 'Unlined'),
(116, 'heart print white short sleeve top.jpg', 'Heart Print White Short Sleeve Top ', 'Tops', 'Kids', 'Girls', 220, 0, 244, 'All over heart print with ruffle sleeve top', 'Round neckline', 'Unlined'),
(117, 'lace smock gray top.jpg', 'White Lace Smock Gray Top ', 'Tops', 'Kids', 'Girls', 270, 0, 209, 'Round neckline', 'Casual Wear ', 'Long sleeves with buttoned cuffs'),
(118, 'multi color cape top.jpg', 'Multi-color Cape Top ', 'Tops', 'Kids', 'Girls', 270, 0, 402, 'High collar neckline', 'Multi-color tone ruffle top with neck bow detail', 'Self tie fastening'),
(119, 'printed smock green top.jpg', 'Printed Smock Green Top ', 'Tops', 'Kids', 'Girls', 269, 0, 455, 'Graphic printed sleeveless top', 'Unlined', 'Square neckline'),
(120, 'shoulder ruffle blue top.jpg', 'Shoulder Ruffle Blue Top ', 'Tops', 'Kids', 'Girls', 225, 0, 176, 'Letter print with ruffle sleeve top', 'Round neckline', 'Slip on style'),
(121, 'A-line yellow floral dress.jpg', 'A-line Yellow Floral Dress ', 'Dress', 'Kids', 'Girls', 325, 0, 102, 'Plain top, floral bottom print sleeveless dress', 'Ribbon design on one shoulder', 'Asymmetrical neckline'),
(122, 'big ribbon pink dress .jpg', 'Big Ribbon Pink Dress ', 'Dress', 'Kids', 'Girls', 350, 0, 117, 'Crew neckline', 'Unlined', 'Zipper closure'),
(123, 'black and white stripe sleeveless dress.jpg', 'Black and White Stripes Sleeveless Dress ', 'Dress', 'Kids', 'Girls', 270, 0, 309, 'Striped sleeveless strap dress', 'Square neckline', 'Regular fit'),
(124, 'blue wrap ruffle denim romper.jpg', 'Blue Wrap Ruffle Denim Romper ', 'Dress', 'Kids', 'Girls', 300, 0, 343, 'Ruffled Sleeveless Romper', 'Elasticized Waist', 'Self tie ribbon'),
(125, 'floral belt white and pink tutu dress.jpg', 'Floral Belt White and Pink Tutu Dress ', 'Dress', 'Kids', 'Girls', 329, 0, 379, 'Shirt sleeve with letter print', 'V-neckline', 'Minky, Soft Tulle, Powernet'),
(126, 'floral black romper jumpsuit.jpg', 'Floral Black Romper Jumpsuit', 'Dress', 'Kids', 'Girls', 299, 0, 257, 'Floral print cold shoulder romper', 'Half bell sleeves type', 'Square neckline'),
(127, 'green stripe dress.jpg', 'Green Stripe Dress ', 'Dress', 'Kids', 'Girls', 310, 0, 327, 'Round neckline', 'Regular fit', 'Slips on'),
(128, 'multi color checkered dress.jpg', 'Multi-color Checkered Dress ', 'Dress', 'Kids', 'Girls', 325, 0, 380, 'Multicolor plaid maxi dress', 'Shallow V-square neckline', 'Sleeveless with ribbon on one strap'),
(129, 'off shoulder strap pink dress.jpg', 'Off-shoulder Strap Pink Dress ', 'Dress', 'Kids', 'Girls', 380, 0, 320, '4 colored balloon dress', 'Off-shoulder neckline', 'Back zip fastening'),
(130, 'pink cat design romper jumpsuit.jpg', 'Pink Cat Design Romper Jumpsuit ', 'Dress', 'Kids', 'Girls', 295, 0, 347, 'Cotton texture pocket detail bodysuit', 'With White graphic printed long sleeves', 'Round neckline'),
(131, 'red checkered singlet dress.jpg', 'Red Checkered Singlet Dress ', 'Dress', 'Kids', 'Girls', 299, 0, 483, 'Check print dress with white long sleeves', 'Elasticized waistband', 'Button fastening'),
(132, 'sleeveless white floral dress.jpg', 'Sleeveless White Floral Dress', 'Dress', 'Kids', 'Girls', 340, 0, 393, 'Round neckline', 'Back zipper fastening', 'Sleeveless'),
(133, 'white sleeveless sequin dress .jpg', 'White Sleeveless Sequin Dress ', 'Dress', 'Kids', 'Girls', 350, 0, 381, 'Square neckline', 'Slip on style', 'Back zipper fastening'),
(134, 'yellow floral printed black dress.jpg', 'Yellow Floral Printed Black Dress ', 'Dress', 'Kids', 'Girls', 325, 0, 497, 'Round neckline', 'Back zip fastening', 'Sleeveless'),
(135, 'purple spaghetti strap romper jumpsuit.jpg', 'Purple Spaghetti Strap Romper Jumpsuit', 'Dress', 'Kids', 'Girls', 280, 0, 399, 'Solid color jumpsuit with ruffled on waist', 'Scoop neckline', 'Spaghetti straps'),
(136, 'army green pants.jpg', 'Army Green Pants ', 'Bottoms', 'Kids', 'Girls', 280, 0, 409, 'New-style trousers', 'Beltloops', 'Elasticized waistband'),
(137, 'blue denim stripe ribbon skirt.jpg', 'Blue Denim Stripe Ribbon Skirt ', 'Bottoms', 'Kids', 'Girls', 265, 0, 336, 'Tiered skirt with ribbon', 'Lined', 'Medium rise'),
(138, 'floral denim pants.jpg', 'Floral Denim Pants ', 'Bottoms', 'Kids', 'Girls', 300, 0, 471, 'Flower and triangle patch denim pants', 'Button and zipper fastening', '5-pockets'),
(139, 'floral white layer skirt.jpg', 'Floral White Layer Skirt ', 'Bottoms', 'Kids', 'Girls', 299, 0, 423, 'Tiered skirt with floral print', 'Lined', 'High rise'),
(140, 'green balloon button shorts.jpg', 'Green Balloon Button Short ', 'Bottoms', 'Kids', 'Boys', 225, 0, 145, 'Solid tone with button designs short', 'Gartered Waist and hem', 'Basics, Smart Casual, Home'),
(141, 'maroon pants.jpg', 'Maroon Pants', 'Bottoms', 'Kids', 'Girls', 300, 0, 143, 'Solid tone ruffled detail sweatpants', 'High rise', 'Elasticized waistband with drawstring'),
(142, 'maroon buttons skirt.jpg', 'Maroon Buttons Skirt ', 'Bottoms', 'Kids', 'Girls', 320, 0, 520, 'Solid tone denim button down mini skirt', 'High rise', 'Lined'),
(143, 'pink ribbon short.jpg', 'Pink Ribbon Short ', 'Bottoms', 'Kids', 'Girls', 250, 0, 302, 'Solid tone ribbon bar pleated short', 'Elasticized back waistband', 'Regular fit '),
(144, 'pink ribbon skirt.jpg', 'Pink Ribbon Skirt ', 'Bottoms', 'Kids', 'Girls', 270, 0, 380, 'Solid tone plain pleated skirt', 'Back zipper fastening', 'High-waisted'),
(145, 'printed bell-bottom pants.jpg', 'Printed Bell-Bottom Pants ', 'Bottoms', 'Kids', 'Girls', 289, 0, 367, 'All over graphic print pants', 'Pleated bell-bottom hem with leopard design', 'Elasticized waistband'),
(146, 'red flower short .jpg', 'Red Flower Short ', 'Bottoms', 'Kids', 'Girls', 265, 0, 321, 'Pure lace mini short', 'Mid rise', 'Regular fit'),
(147, 'twill cargo pink pants.jpg', 'Twill Cargo Pink Pants ', 'Bottoms', 'Kids', 'Girls', 340, 0, 267, 'Solid tone cargo pants with lines', 'High Rise', 'Ankle length'),
(148, 'yellow long skirt.jpeg', 'Yellow Long Skirt', 'Bottoms', 'Kids', 'Girls', 279, 0, 280, 'Layered overlay maxi skirt', 'High rise', 'Elasticized waistband'),
(149, 'blue cotton denim shorts.jpg', 'Blue Cotton Denim Short', 'Bottoms', 'Kids', 'Girls', 230, 0, 464, 'Mid rise', 'Elasticized waistband with ribbon tie', '2 Side pockets'),
(150, 'ruffle edge pink shorts.jpg', 'Ruffle Edge Pink Short ', 'Bottoms', 'Kids', 'Girls', 259, 0, 250, 'Solid toned ruffle trimmed shorts', 'Gartered waist', 'Ruffled top and bottom shorts'),
(151, '1. White Slim Fit Suit.jpg', 'White Slim Fit Suit ', 'Formal Attire', 'Men', '', 2590, 0, 352, 'Professional Hand Made Stitching', 'Premium Cloth Material', 'Deluxe White Horse Color'),
(152, '2. Black Synthetic Notch Lapel Suit.jpg', 'Black Synthetic Notch Lapel Suit ', 'Formal Attire', 'Men', '', 2800, 0, 250, '4 Button Vest', 'Lightweight Pants', 'Un ironed White Polo'),
(153, '3. White Poly Viscose Tuxedo.jpg', 'White Poly Viscose Tuxedo', 'Formal Attire', 'Men', '', 3199, 0, 300, 'Tip Top Black Top Hat', 'White Short Coat', 'Black 4 Button Shirt with A Bow Tie'),
(154, '4. Blue Slim Fit Single Breasted Suit.jpg', 'Blue Slim Fit Single-Breasted Suit ', 'Formal Attire', 'Men', '', 3498, 0, 420, 'Nanotech Self Repairing Suit', 'Office Manager Type of Suit', 'White Shirt with White Necktie'),
(155, '5. Blue Synthetic Notch Lapel Suit.jpg', 'Blue Synthetic Notch Lapel Suit ', 'Formal Attire', 'Men', '', 2800, 0, 400, 'Shiny Blue Synthetic Material', 'Material Came From the caves of south Africa', 'Shiny Reddish Spiky Shoes'),
(156, '7. Gray Solid Slim Suit.jpg', 'Gray Solid Slim Suit ', 'Formal Attire', 'Men', '', 2789, 0, 300, 'Shiny Gray premium suit', 'Slim type of pants', 'Black formal shoes'),
(157, '6. Blue Checkered Slim Fit Suit.jfif', 'Blue Checkered Slim Fit Suit ', 'Formal Attire', 'Men', '', 2800, 0, 160, 'Checkered Coat with White lines', 'Single button technique', 'Spiky Brownish Black Shoes'),
(158, '8. Dark Blue Formal Suit.jpg', 'Dark Blue Formal Suit ', 'Formal Attire', 'Men', '', 2590, 0, 250, 'Complete Dark Blue setup', 'Even up in the necktie', 'Sharp Edged Shoes'),
(159, '9. Gray Polyester and Cotton Suit.jpg', 'Gray Polyester and Cotton Suit', 'Formal Attire', 'Men', '', 2650, 0, 400, 'Deluxe Kind of Formal Attire', 'His feet are crossed in order to gain attention', 'Silly dark blue necktie which ruins the looks'),
(160, '10. Black Slim Fit Single Breasted Tuxedo.jfif', 'Black Slim Fit Single Breasted Tuxedo', 'Formal Attire', 'Men', '', 2800, 0, 0, 'Detective like feels attending a party', 'Avoid anyone who wears this at all cost', 'Because you can lose your girl instantly '),
(161, '11. Black-Gray Synthetic Notch Lapel Suit.jpg', 'Black-Gray Synthetic Notch Lapel Suit', 'Formal Attire', 'Men', '', 2800, 0, 268, 'Unbuttoned suit with long necktie', 'The model seems a bit tired', 'Premium material'),
(162, '12. Dark Casual Tuxedo .jfif', 'Dark Casual Tuxedo ', 'Formal Attire', 'Men', '', 2699, 0, 221, 'Looks like a person who works in a bar', 'Mostly attends parties', 'Especially weddings'),
(163, '13. Yellow Double Breasted Tuxedo .jfif', 'Yellow Double Breasted Tuxedo ', 'Formal Attire', 'Men', '', 3800, 0, 406, 'Slit fit suit set', 'Making you look more handsome.', 'Looks like a raincoat from a far'),
(164, '14. Yellow Polyester and Cotton Suit.jpg', 'Yellow Polyester and Cotton Suit ', 'Formal Attire', 'Men', '', 3749, 0, 461, 'A little bit pale', 'Well ironed', 'Premium material made'),
(165, '15. Bright Mustard Slim Fit Suit.jfif', 'Bright Mustard Slim Fit Suit ', 'Formal Attire', 'Men', '', 2800, 0, 326, 'Smooth surface looks stylish ', 'Center of attention', 'Head turner'),
(166, '16. Purple Solid Two Piece Two Button Suit.jpg', 'Purple Solid Two Piece Two Button Suit', 'Formal Attire', 'Men', '', 2789, 0, 263, 'Awesome pink necktie', 'Give you a handsome and stylish look', 'Suitable for many occasions'),
(167, '17. Violet Double Breasted Tuxedo.jpg', 'Violet Double-Breasted Tuxedo ', 'Formal Attire', 'Men', '', 3800, 0, 475, 'It is made of high quality materials', 'Stylish and fashion design', 'Comfortable material'),
(168, '18. Dark Blue Classic Business Suit.jfif', 'Dark Blue Classic Business Suit', 'Formal Attire', 'Men', '', 2590, 0, 0, 'Wants to gain attention ', 'Just like the yellow one ', 'Regular fit'),
(169, '19. Maroon Modern Slim Fit Tuxedo.jpg', 'Maroon Modern Slim Fit Tuxedo ', 'Formal Attire', 'Men', '', 2899, 0, 393, 'Alcan Tara leather material', 'Soft to the touch ', 'Looks like a carpet made into a suit'),
(170, '20. Blue Skinny Fit Stretch Tuxedo.jpg', 'Blue Skinny Fit Stretch Tuxedo ', 'Formal Attire', 'Men', '', 2699, 0, 399, 'Regular type of formal attire', 'Has a silly striped bow tie', 'Single button technique'),
(171, 'Blue  White Toddler Bundle Set.jpg', 'Blue & White Toddler Bundle Set ', '', 'Kids', 'Toddlers', 649, 0, 420, 'Set with a long-sleeved bodysuit', 'An all-in-one suit', 'A hat in soft organic cotton jersey'),
(172, '2. Ultimate Baby Short Sleeve Bodysuits.jpg', 'Ultimate Baby Short Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 530, 0, 200, 'Bodysuit with press-studs at the crotch', 'All-in-one suit with an elephant toy design', 'Press-studs down the front and at the crotch'),
(173, '3. Printed Toddler Bundler Set.jpg', 'Printed Toddler Bundler Set', '', 'Kids', 'Toddlers', 599, 0, 320, 'Elasticated heels and full feet.', 'All-in-one suit with blue unidentified patches', 'Soft to the touch'),
(174, '4. Pooh Complete Body Bundle Set.jpg', 'Pooh Complete Body Bundle Set ', '', 'Kids', 'Toddlers', 699, 0, 250, 'Soft comfortable texture', 'Official Winnie The Pooh Collector’s Item', 'Includes food and beverage spill cloth'),
(175, '5. Green & Blue Striped Longsleeves and Pants.jfif', 'Green & Blue Striped Long Sleeves and Pants ', '', 'Kids', 'Toddlers', 620, 0, 381, 'A not so all-in-one suit', 'Has a hoodie shirt but the bonnet is also included', 'Has string on its belly to improved stability'),
(176, '6. Gray for Winter Clothes Pair for girls.jfif', 'Gray for Winter Clothes Pair for Girls ', '', 'Kids', 'Toddlers', 599, 0, 300, 'Dotted gray clothing', 'Has some thick material', 'Best used in cold weathers'),
(177, '7. Printed Red Short Sleeve Bodysuits.jpg', 'Printed Red Short Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 300, 0, 424, 'Single piece toddler suit', 'Has a Spanish like words intact', 'When your kid bleeds this won’t make a mark'),
(178, '8. Red Monkey Long Sleeve Bodysuits.jfif', 'Red Monkey Long Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 330, 0, 461, 'Has some nice inspiring phrase', 'Cool red and white design', 'With monkey patches'),
(179, '9. Red Baby Buckeye Short Sleeve Bodysuits.jfif', 'Red Baby Buckeye Short Sleeve Bodysuit', '', 'Kids', 'Toddlers', 300, 0, 216, 'Red toddler suit but with different design', 'Creepy design which bring some chills', 'Red material cloth for bleed proofing'),
(180, '10. Blue Long Sleeve Bodysuits.jpg', 'Blue Long Sleeve Bodysuits', '', 'Kids', 'Toddlers', 299, 0, 201, 'The suit of a rich kid', 'If your kid is wearing this kind of suit, you are rich', 'Cool blue material color'),
(181, '11. Cream Winter Gamuza Bodysuits.jpg', 'Cream Winter Gamuza Bodysuits', '', 'Kids', 'Toddlers', 478, 0, 234, 'For the real deal type of winter', 'Feels like you have a little bear', 'Came from the authentic bear skin'),
(182, '12. Gray Bear Short Sleeve Bodysuits.jpg', 'Gray Bear Short Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 370, 0, 403, 'Skinny toddler suit', 'Has an old bear in jumpers', 'Your kid will look old if you wear them with this'),
(183, '13. Atlantic Soul Short Sleeve Bodysuits.jpeg', 'Atlantic Soul Short Sleeve Bodysuits', '', 'Kids', 'Toddlers', 320, 0, 416, 'The fisherman’s kid suit', 'Great for adventures', 'Especially when on the beach'),
(184, '14. Perfect Combination Short Sleeve Bodysuits.jpg', 'Perfect Combination Short Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 290, 0, 408, 'Thick white cloth material', 'Great for great indoors', 'The phrase doesn’t make any sense'),
(185, '15. Star Short Sleeve Bodysuits.jpg', 'Star Short Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 240, 0, 402, 'Star toddler suit design', 'The cloth looks thick but it is not', 'Great minimalist design'),
(186, '16. Elephant Printed Sleep and Play Pjs Boysuits.jpg', 'Elephant Printed Sleep and Play Pajamas Bodysuits', '', 'Kids', 'Toddlers', 275, 0, 264, 'Cool look of elephant', 'Toddler’s least favorite suit', 'Best used when the toddler is in the hospital'),
(187, '17. Ultimate Baby Sleep and Play Pjs Bodsuits.jfif', 'Ultimate Baby Sleep and Play Pajamas Bodysuits ', '', 'Kids', 'Toddlers', 260, 0, 422, 'Another toddler suit that is mostly used in hospitals', 'Design is too plain to look', 'Nice cool blue lining'),
(188, '18.jpg', 'Printed Blue Long Sleeve Bodysuits ', '', 'Kids', 'Toddlers', 349, 0, 252, 'Castle and dragon design', 'Too medieval I would say', 'Best when your kid is too barbaric'),
(189, '19.jpeg', 'Black & White Printed Cat Long Sleeve Bodysuits', '', 'Kids', 'Toddlers', 359, 0, 250, 'Abstract cat design', 'Minimalist', 'Great for toddlers'),
(190, '20.jfif', 'Yellow Double Layer Long Sleeve Bodysuits for Girls ', '', 'Kids', 'Toddlers', 469, 0, 320, 'A “baby girl walking in the park” starter pack', 'Has some unidentified designs', 'Except for the little duck in the middle'),
(191, 'viccki.jpg', 'VICCKI Cotton Shirt', 'Tops', 'Men', '', 379, 0, 0, 'Special Fabric', 'Fashion design', 'This is a great gift for your lovers or yourself.'),
(192, 'Nike aw77.jpg', 'Nike AW77 Alumni Shorts', 'Bottoms', 'Men', '', 320, 0, 0, '37% Cotton', 'Fastening: Elastic, Drawstring', 'Men Alumni Shorts'),
(193, 'training girl.jpg', 'TrainingGirl High Waist Sauna Sweat Shorts', 'Bottoms', 'Women', '', 199, 0, 0, 'Inner: 100% neoprene, Outer: 100% polyester.', 'Stimulate sweat and fat burning', 'High waist and tummy control'),
(194, 'saingace.jpg', 'Saingace Women Black Dresses', 'Dress', 'Women', '', 500, 0, 0, ' Light and comfortable', 'Soft material', 'Polyester'),
(195, 'little boys summer.jpg', 'BEILEI CREATIONS Little Boys Summer Cotton Strip', 'Tops', 'Kids', 'Boys', 300, 0, 0, 'Cute embroidery', 'Well made and adorable', '100% Cotton'),
(196, 'baby girls kid denim.jpg', 'Denim Ruched Long Sleeve', 'Tops', 'Kids', 'Girls', 320, 0, 0, 'Made of a Soft Comfortable Cotton Fabric', 'Perfect for Your Babies Go Outside', 'Comfortable Fabric'),
(197, 'girl flowe tshirt.jpg', 'Flower T-Shirts Long Button Down Shirt', 'Tops', 'Kids', 'Girls', 399, 0, 220, 'Cotton Linen Fabric', 'Comfy & Soft', 'Great for daily wear'),
(198, 'dance gym.jpg', 'Dance Gym Sports Pink', 'Bottoms', 'Kids', 'Girls', 300, 0, 0, '100% Cotton', 'Trendy Fashion Summer Hot Pants Shorts', 'Elasticated Waist'),
(199, '4f.jpg', 'taitaibaby Girls Shorts', 'Bottoms', 'Kids', 'Girls', 250, 0, 300, '95% Cotton, 5% Spandex', 'Well made and durable kids active shorts', 'Elastic closure'),
(200, 'flower dress.jpg', 'NSSMWTTC 2-10 Years Flower Girls', 'Dress', 'Kids', 'Girls', 800, 0, 0, 'Girls Pageant or Party Dress', 'More Suit for 2-9 Years Old Kids Princess', 'Gentle wash and hang dry recommended');

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE `tbltransaction` (
  `transactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `customerName` varchar(100) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Total` int(11) NOT NULL,
  `Time` varchar(100) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Payment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userID` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `Firstname` char(100) NOT NULL,
  `Lastname` char(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `HouseNo` int(11) NOT NULL,
  `Street` varchar(100) NOT NULL,
  `Brgy` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Province` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `Access` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userID`, `photo`, `Firstname`, `Lastname`, `email`, `Password`, `HouseNo`, `Street`, `Brgy`, `City`, `Province`, `phone`, `status`, `Access`) VALUES
(1, 'ngJ-ckal_400x400.jpg', 'Rico', 'Guinanao', 'guinanaorico@gmail.com', 'rics_', 76, ' Majada In ', 'Canlubang ', 'Calamba ', 'Laguna ', '+639126546881', 'offline.png', 'Admin'),
(2, '120877490_649720405918110_6369792015635090048_o.jpg', 'Albert', 'Gaces', 'albertgaces@gmail.com', 'aiza_', 145, ' Mango ', 'Mayapa ', 'Calamba ', 'Laguna ', '+639124567899', 'offline.png', 'Admin'),
(3, '119116446_1428227754038754_2755318469059966094_o.jpg', 'Mikee', 'Gonzales', 'mikeegonzales@gmail.com', 'mikee', 21, ' Apple        ', 'Barangay 3        ', 'Calamba        ', 'Laguna        ', '+639632707710', 'offline.png', 'User'),
(4, '57649357_1218116311688858_878955788586975232_n.jpg', 'Precious', 'Genil', 'preciousgenil@gmail.com', 'precious', 45, ' Orange ', 'Sirang Lupa ', 'Calamba ', 'Laguna ', '+639152527368', 'offline.png', 'User'),
(5, '121043889_3432265150224886_9111203001507946193_n.jpg', 'Regine', 'Famoso', 'reginefamoso@gmail.com', 'regine_', 23, '   Rizal    ', 'Barangay 2    ', 'Calamba    ', 'Laguna    ', '+639251234324', 'offline.png', 'User'),
(6, '140255253_10219423885088007_3478036622646241104_n.jpg', 'Roda Flor Andrea', 'Teodocio', 'rfa.teodocio@gmail.com', 'missA', 71, ' Phase 6 ', 'Mamatid ', 'Cabuyao ', 'Laguna ', '+639254496685', 'offline.png', 'Supervisor'),
(7, '140255253_10219423885088007_3478036622646241104_n2.jpg', 'Roda Flor Andrea', 'Teodocio', 'rodaflorandrea@gmail.com', 'miss_a', 12, ' Phase 6 ', 'Banlic ', 'Cabuyao ', 'Laguna ', '+639254496685', 'offline.png', 'Admin'),
(8, 'Nekhros ARTSTYLE.jpg', 'Rico', 'Guinanao', 'ricoguinanao@yahoo.com', 'ricss', 14, ' Majada In ', 'Canlubang ', 'Calamba ', 'Laguna ', '+639251486985', 'offline.png', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblinventory`
--
ALTER TABLE `tblinventory`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
