--- Users ---

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

-- password: monkey
INSERT INTO
  users (id, username, password)
VALUES
  (
    1,
    'stephanie',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );

-- password: monkey
INSERT INTO
  users (id, username, password)
VALUES
  (
    2,
    'sharon',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );


--- Sessions ---

CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);


--- Groups ----

CREATE TABLE groups (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL UNIQUE
);

INSERT INTO
  groups (id, name)
VALUES
  (1, 'admin');


--- Group Membership -> create a relationship table between the group and the user of a user ---

CREATE TABLE memberships (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  group_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

-- User 'kyle' is a member of the 'admin' group.
INSERT INTO
  memberships (group_id, user_id)
VALUES
  (1, 1);



-- PLANT DATA BELOW --

-- CLASSIFICATIONS -> an id for each type of class --

CREATE TABLE classifications (
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	classificationname	TEXT NOT NULL
);

INSERT INTO
  classifications (id, classificationname)
VALUES
  (1, 'Shrub');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (2, 'Grass');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (3, 'Vine');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (4, 'Tree');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (5, 'Flower');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (6, 'Groundcovers');

INSERT INTO
  classifications (id, classificationname)
VALUES
  (7, 'Other [Mosses, Ferns, Vegetables, etc.]');

-- DETAILS -> an id for each type of growth detail --
CREATE TABLE details (
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	detailname TEXT NOT NULL
);

INSERT INTO details (id, detailname) VALUES (1, 'Perennial');
INSERT INTO details (id, detailname) VALUES (2, 'Annual');
INSERT INTO details (id, detailname) VALUES (3, 'Full Sun');
INSERT INTO details (id, detailname) VALUES (4, 'Partial Shade');
INSERT INTO details (id, detailname) VALUES (5, 'Full Shade');

-- PLANTS -> basic info! --
CREATE TABLE plants (
    id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	plant_name_c TEXT NOT NULL UNIQUE,
    plant_name_s TEXT NOT NULL UNIQUE,
    plant_image TEXT NOT NULL UNIQUE,
    hardiness_zone_range TEXT NOT NULL,

    constructive_play INTEGER NOT NULL,
    sensory_play INTEGER NOT NULL,
    physical_play INTEGER NOT NULL,
    imaginative_play INTEGER NOT NULL,
    restorative_play INTEGER NOT NULL,
    expressive_play INTEGER NOT NULL,
    play_with_rules INTEGER NOT NULL,
    bio_play INTEGER NOT NULL
);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (1, 'Giant Iron Weed', 'Vernonia gigantea', 'GA_15', '5-8', 1, 1, 0, 1, 1, 0, 1, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (2, "Lady's mantle", 'Alchemilla mollis', 'FL_26', '3-8', 0, 1, 1, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (3, "American Cranberry", 'Vaccinium macrocarpon', 'GR_03', '3-6', 0, 1, 1, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (4, "Jostaberry", 'Ribes x nidigrolaria', 'SH_19', '3-8', 0, 1, 1, 0, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (5, "Camperdown Elm", "Ulmus glabra 'Camperdownii'", 'TR_30', '4-6', 1, 1, 1, 0, 1, 0, 0, 0);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (6, "Houseleek 'Mahogany'", "Sempervivum rubellum 'Mahogany'", 'GR_09', '5-8', 0, 1, 0, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (7, "Hen & Chicks 'Red Lion'", "Sempervivum 'Red Lion'", 'GR_07', '4-7', 0, 1, 0, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (8, "Silky Willow", "Salix sericea", 'SH_01', '4-8', 1, 1, 1, 0, 1, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (9, "Red Osier Dogwood (Red Twig Dogwood)", "Cornus sericea", 'SH_29', '3-7', 0, 1, 1, 0, 0, 0, 1, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (10, "River Birch", "Betula nigra", 'TR_23', '3-9', 1, 1, 1, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (11, "Flowering Raspberry", "Rubus odoratus", 'SH_33', '4-6', 0, 1, 1, 0, 0, 0, 0, 1) ;

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (12, "Spiked Gay-Feather", "Liatris spicata", 'FL_05', '3-9', 0, 1, 1, 0, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (13, "Broad-leaf Sedge", "Carex platyphylla", 'GA_05', '4-9', 1, 1, 0, 1 , 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (14, "Goat Willow", "Salix caprea", 'SH_09', '5-8', 0, 1, 1, 0, 1, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (15, "Christmas fern", "Polystichum acrostichoides", 'FE_12', '3-9', 0, 1, 0, 1, 0, 0, 0, 1);

INSERT INTO
  plants (id, plant_name_c, plant_name_s, plant_image, hardiness_zone_range, constructive_play, sensory_play, imaginative_play, physical_play, restorative_play, expressive_play, play_with_rules, bio_play)
VALUES
  (16, "Harry Lauder's Walking stick", "Corylus avellana 'Contorta'", 'SH_03', '4-8', 0, 1, 1, 1, 1, 0, 0, 1);

CREATE TABLE detail_tags (
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_id INTEGER NOT NULL,
  detail_id INTEGER NOT NULL,

  FOREIGN KEY (plant_id) REFERENCES plants(id),
  FOREIGN KEY (detail_id) REFERENCES details(id)
);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (1, 1, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (2, 1, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (3, 1, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (4, 2, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (5, 2, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (6, 2, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (7, 3, 3);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (8, 4, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (9, 4, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (10, 4, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (11, 5, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (12, 5, 3);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (13, 6, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (14, 6, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (15, 6, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (16, 7, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (17, 7, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (18, 7, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (19, 8, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (20, 8, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (21, 8, 4);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (22, 8, 5);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (23, 9, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (24, 9, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (25, 9, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (26, 10, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (27, 10, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (28, 10, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (29, 11, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (30, 11, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (31, 11, 4);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (32, 11, 5);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (33, 12, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (34, 12, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (35, 12, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (36, 13, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (37, 13, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (38, 13, 5);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (39, 14, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (40, 14, 4);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (41, 15, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (42, 15, 4);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (43, 14, 5);

INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (44, 16, 1);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (45, 16, 3);
INSERT INTO detail_tags(id, plant_id, detail_id) VALUES (46, 16, 4);

CREATE TABLE classification_tags (
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_id INTEGER NOT NULL,
  classification_id INTEGER NOT NULL,

  FOREIGN KEY (plant_id) REFERENCES plants(id),
  FOREIGN KEY (classification_id) REFERENCES classifications(id)
);

INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (1, 1, 2);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (2, 2, 5);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (3, 3, 6);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (4, 4, 1);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (5, 5, 4);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (6, 6, 6);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (7, 7, 5);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (8, 8, 1);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (9, 9, 1);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (10, 10, 4);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (11, 11, 2);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (12, 12, 5);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (13, 13, 2);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (14, 14, 1);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (15, 15, 7);
INSERT INTO classification_tags(id, plant_id, classification_id) VALUES (16, 16, 1);

-- IMAGES -> store extension of the image for each plant --
CREATE TABLE images (
	id	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_id INTEGER NOT NULL,
  extension INTEGER NOT NULL,

  FOREIGN KEY (plant_id) REFERENCES plants(id)
);

INSERT INTO images(id, plant_id, extension) VALUES (1, 1, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (2, 2, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (3, 3, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (4, 4, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (5, 5, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (6, 6, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (7, 7, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (8, 8, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (9, 9, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (10, 10, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (11, 11, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (12, 12, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (13, 13, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (14, 14, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (15, 15, 'jpg');
INSERT INTO images(id, plant_id, extension) VALUES (16, 16, 'jpg');
