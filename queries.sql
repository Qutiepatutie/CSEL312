INSERT INTO store_categories VALUES
('1', 'Hats', 'Funky hats in all shapes and sizes!'),
('2', 'Shirts', 'From t-shirts to sweatshirts to polo shirts and beyond.'),
('3', 'Books', 'Paperback, hardback, books for school or play.');

INSERT INTO store_items VALUES 
('1', '1', 'Baseball Hat', '12.00', 'Fancy, low-profile baseball hat.', 'baseballhat.gif'),
('2', '1', 'Cowboy Hat', '52.00', '10 gallon variety', 'cowboyhat.gif'),
('3', '1', 'Top Hat', '102.00', 'Good for costumes.', 'tophat.gif'),
('4', '2', 'Short-Sleeved T-Shirt', '12.00', '100% cotton, pre-shrunk.', 'sstshirt.gif'),
('5', '2', 'Long-Sleeved T-Shirt', '15.00', 'Just like the short-sleeved shirt, with longer sleeves.', 'lstshirt.gif'),
('6', '2', 'Sweatshirt', '22.00', 'Heavy and warm.', 'sweatshirt.gif'),
('7', '3', 'Jane\'s Self-Help Book', '12.00', 'Jane gives advice.', 'selfhelpbook.gif'), 
('8', '3', 'Generic Academic Book', '35.00', 'Some required reading for school, will put you to sleep.', 'boringbook.gif'), 
('9', '3', 'Chicago Manual of Style', '9.99', 'Good for copywriters.', 'chicagostyle.gif');

INSERT INTO store_item_size (item_id, item_size) VALUES 
(1,'One Size Fits All'), 
(2,'One Size Fits All'), 
(3,'One Size Fits All'), 
(4,'S'), 
(4,'M'), 
(4,'L'),
(4,'XL');

INSERT INTO store_item_color (item_id, item_color) VALUES 
(1,'red'),
(1,'black'), 
(1,'blue');