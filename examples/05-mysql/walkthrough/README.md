# Database Setup Walkthrough

1. Create database
    - name: `example`
1. Create table

    ```sql
    CREATE TABLE `example`.`projects` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(40) NOT NULL , `image` VARCHAR(40) NOT NULL , `description` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
    ```

1. Import CSV data
    - [Import Help](https://stackoverflow.com/questions/16247944/invalid-column-count-in-csv-input-on-line-1-error)
1. Build `index.php`
1. What's up with the pictures?
1. Fix the database structure

    ```sql
    ALTER TABLE `projects` CHANGE `image` `image` VARCHAR(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL;
    ```

1. Update the database content

    ```sql
    UPDATE `projects` SET `image`= 'https://source.unsplash.com/random/640x360'
    ```