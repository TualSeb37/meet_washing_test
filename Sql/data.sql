INSERT INTO car 
(id, car_id, number_plate, car_type, release_date)
VALUES
(1, '6669c9f9ceef1', 'FR-123-AA', 'citadine', 2020-06-01 00:00:00),
(2, '6669c9f9da1df', 'AC-234-AB', 'SUV', 2020-09-01 00:00:00),
(3, '6669c9f9dae85', 'AZ-345-BA', 'cabriolet', 2019-07-01 00:00:00),
(4, '6669c9f9db8fc', 'YU-987-NH', 'citadine', 2018-02-01 00:00:00),
(5, '6669c9f9dc4ac', 'JK-098-ML' , '4X4', 2015-02-01 00:00:00),
(6, '6669c9fa7a2c6', 'FR-123-AA' , 'citadine', 2020-06-01 00:00:00),
(7, '6669c9fa7c494', 'AC-234-AB' , 'SUV', 2020-09-01 00:00:00),
(8, '6669c9fa7cc4a', 'AZ-345-BA' , 'cabriolet', 2019-07-01 00:00:00),
(9, '6669c9fa7d291', 'YU-987-NH' , 'citadine', 2018-02-01 00:00:00),
(10, '6669c9fa7d7ca', 'JK-098-ML', '4X4', 2015-02-01 00:00:00)
;

INSERT INTO picture 
(id, car_id, thumbnail)
VALUES
( 1, 1, 'image 1' ),
( 2, 2, 'image 2' ),
( 3, 3, 'image 3' ),
( 4, 4, 'image 4' ),
( 5, 5, 'image 5' ),
( 6, 6, 'image 6' ),
( 7, 1, 'image 7' ),
( 8, 1, 'image 8' ),
( 9, 2, 'image 8' ),
( 10, 2, 'image 10')
;