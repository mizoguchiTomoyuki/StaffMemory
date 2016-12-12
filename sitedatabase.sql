Create table logindata(
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(30) NOT NULL,
`mail` VARCHAR(255) NOT NULL,
`pass` VARCHAR(255) NOT NULL,
PRIMARY KEY(`id`)
);

Create table thread(
`id` INT NOT NULL AUTO_INCREMENT,
`article` VARCHAR(255) NOT NULL,
`date` datetime NOT NULL,
`userid` INT NOT NULL,
PRIMARY KEY(`id`)
);

Create table taginfo(
`id` INT NOT NULL AUTO_INCREMENT,
`threadid` INT NOT NULL,
`tagid` INT NOT NULL,
PRIMARY KEY(`id`)
);

Create table tagtable(
`id` INT NOT NULL AUTO_INCREMENT,
`name` VARCHAR(30) NOT NULL,
PRIMARY KEY(`id`)
);