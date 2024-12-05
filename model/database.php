<?php

include_once(__DIR__ . "/../config.php");
include_once(__DIR__ . "/administrator.php");
include_once(__DIR__ . "/specie.php");
include_once(__DIR__ . "/animal.php");
include_once(__DIR__ . "/animal_join_specie.php");
include_once(__DIR__ . "/event.php");
include_once(__DIR__ . "/visitor.php");
include_once(__DIR__ . "/attendance.php");
include_once(__DIR__ . "/attendance_join_event.php");
include_once(__DIR__ . "/attendance_join_event_join_visitor.php");
include_once(__DIR__ . "/page.php");



$mysqli_connection = new mysqli($server, $username, $password, $database);

if ($mysqli_connection->connect_error)
    throw new Exception("Database connection error");
else
    /* do nothing */;


class database
{
    public static function select_admin_by_login_info (
        string $username,
        string $password
    ) : ?administrator
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, username, password
            FROM administrator
            WHERE username = '{$username}'
            AND password = '{$password}'
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);

            $id       = (int) $record["id"];
            $username = $record["username"];
            $password = $record["password"];

            return new administrator($id, $username, $password);
        }
        else {
            return null;
        }
    }

    public static function select_latest_specie_id () : ?int
    {
        global $mysqli_connection;

        $sql = "
            SELECT id
            FROM specie
            ORDER BY id DESC
            LIMIT 1;
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);
            $id = (int) $record["id"];
            return $id;
        }
        else {
            return null;
        }
    }

    public static function insert_into_specie (specie $specie) : void
    {
        global $mysqli_connection;

        $name        = $mysqli_connection->real_escape_string($specie->get_name());
        $description = $mysqli_connection->real_escape_string($specie->get_description());
        $image_url   = $mysqli_connection->real_escape_string($specie->get_image_url());
        $featured = (int) $specie->get_featured();

        $sql = "
            INSERT INTO specie (id, name, description, image_url, featured)
            VALUES ( {$specie->get_id()}
                   , '{$name}'
                   , '{$description}'
                   , '{$image_url}'
                   , {$featured}
                   )
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Insertion failed");
        }
    }

    public static function select_all_specie () : array
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, name, description, image_url, featured
            FROM specie
        ";

        $result_set = $mysqli_connection->query($sql);

        $all_species = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);
                $featured    = (bool) $record["featured"];

                $specie = new specie($id, $name, $description, $image_url, $featured);
                array_push($all_species, $specie);
            }
        }

        return $all_species;
    }

    public static function select_featured_specie () : array
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, name, description, image_url, featured
            FROM specie
            WHERE featured = 1
            LIMIT 4
        ";

        $result_set = $mysqli_connection->query($sql);

        $all_species = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);
                $featured    = (bool) $record["featured"];

                $specie = new specie($id, $name, $description, $image_url, $featured);
                array_push($all_species, $specie);
            }
        }

        return $all_species;
    }

    public static function select_specie_by_id (int $id) : ?specie
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, name, description, image_url, featured
            FROM specie
            WHERE id = {$id}
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);

            $id          = (int) $record["id"];
            $name        = stripslashes($record["name"]);
            $description = stripslashes($record["description"]);
            $image_url   = stripslashes($record["image_url"]);
            $featured    = (bool) $record["featured"];

            $specie = new specie($id, $name, $description, $image_url, $featured);
            return $specie;
        }
        else {
            return null;
        }
    }

    public static function select_specie_by_name (string $name) : ?specie
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, name, description, image_url, featured
            FROM specie
            WHERE name = '{$name}'
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);

            $id          = (int) $record["id"];
            $name        = stripslashes($record["name"]);
            $description = stripslashes($record["description"]);
            $image_url   = stripslashes($record["image_url"]);
            $featured    = (bool) $record["featured"];

            $specie = new specie($id, $name, $description, $image_url, $featured);
            return $specie;
        }
        else {
            return null;
        }
    }

    public static function update_specie (specie $specie) : void
    {
        global $mysqli_connection;

        $name        = $mysqli_connection->real_escape_string($specie->get_name());
        $description = $mysqli_connection->real_escape_string($specie->get_description());
        $image_url   = $mysqli_connection->real_escape_string($specie->get_image_url());
        $featured = (int) $specie->get_featured();

        $sql = "
            UPDATE specie
            SET name        = '{$name}',
                description = '{$description}',
                image_url   = '{$image_url}',
                featured    = {$featured}
            WHERE id = {$specie->get_id()}
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Update failed");
        }
    }

    public static function delete_from_specie (specie $specie) : void
    {
        global $mysqli_connection;

        $sql = "
            DELETE FROM specie
            WHERE id = {$specie->get_id()}
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Deletion failed");
        }
    }

    public static function select_latest_animal_id () : ?int
    {
        global $mysqli_connection;

        $sql = "
            SELECT id
            FROM animal
            ORDER BY id DESC
            LIMIT 1;
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);
            $id = (int) $record["id"];
            return $id;
        }
        else {
            return null;
        }
    }

    public static function insert_into_animal (animal $animal) : void
    {
        global $mysqli_connection;

        $name        = $mysqli_connection->real_escape_string($animal->get_name());
        $description = $mysqli_connection->real_escape_string($animal->get_description());
        $image_url   = $mysqli_connection->real_escape_string($animal->get_image_url());

        $sql = "
            INSERT INTO animal (id, specie_id, name, description, image_url)
            VALUES ( {$animal->get_id()}
                   , {$animal->get_specie_id()}
                   , '{$name}'
                   , '{$description}'
                   , '{$image_url}'
                   )
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Insertion failed");
        }
    }

    public static function select_all_animal () : array
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, specie_id, name, description, image_url
            FROM animal
        ";

        $result_set = $mysqli_connection->query($sql);

        $all_animals = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $specie_id   = (int) $record["specie_id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);

                $animal = new animal($id, $specie_id, $name, $description, $image_url);
                array_push($all_animals, $animal);
            }
        }

        return $all_animals;
    }

    public static function select_animal_by_specie_id (int $specie_id) : array
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, specie_id, name, description, image_url
            FROM animal
            WHERE specie_id = {$specie_id}
        ";

        $result_set = $mysqli_connection->query($sql);

        $selected_animals = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $specie_id   = (int) $record["specie_id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);

                $animal = new animal($id, $specie_id, $name, $description, $image_url);
                array_push($selected_animals, $animal);
            }
        }

        return $selected_animals;
    }

    public static function select_all_animal_order_by_name () : array
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, specie_id, name, description, image_url
            FROM animal
            ORDER BY name ASC
        ";

        $result_set = $mysqli_connection->query($sql);

        $all_animals = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $specie_id   = (int) $record["specie_id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);

                $animal = new animal($id, $specie_id, $name, $description, $image_url);
                array_push($all_animals, $animal);
            }
        }

        return $all_animals;
    }

    public static function select_animal_by_specie_name_order_by_animal_name (string $specie_name) : array
    {
        $specie = database::select_specie_by_name($specie_name);

        global $mysqli_connection;

        $sql = "
            SELECT id, specie_id, name, description, image_url
            FROM animal
            WHERE specie_id = {$specie->get_id()}
            ORDER BY name ASC
        ";

        $result_set = $mysqli_connection->query($sql);

        $selected_animals = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $specie_id   = (int) $record["specie_id"];
                $name        = stripslashes($record["name"]);
                $description = stripslashes($record["description"]);
                $image_url   = stripslashes($record["image_url"]);

                $animal = new animal($id, $specie_id, $name, $description, $image_url);
                array_push($selected_animals, $animal);
            }
        }

        return $selected_animals;
    }

    public static function select_animal_by_id (int $id) : ?animal
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, specie_id, name, description, image_url
            FROM animal
            WHERE id={$id}
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);

            $id          = (int) $record["id"];
            $specie_id   = (int) $record["specie_id"];
            $name        = stripslashes($record["name"]);
            $description = stripslashes($record["description"]);
            $image_url   = stripslashes($record["image_url"]);

            $animal = new animal($id, $specie_id, $name, $description, $image_url);
            return $animal;
        }
        else {
            return null;
        }
    }

    public static function update_animal (animal $animal) : void
    {
        global $mysqli_connection;

        $name        = $mysqli_connection->real_escape_string($animal->get_name());
        $description = $mysqli_connection->real_escape_string($animal->get_description());
        $image_url   = $mysqli_connection->real_escape_string($animal->get_image_url());

        $sql = "
            UPDATE animal
            SET specie_id   = {$animal->get_specie_id()},
                name        = '{$name}',
                description = '{$description}',
                image_url   = '{$image_url}'
            WHERE id = {$animal->get_id()}
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Update failed");
        }
    }

    public static function delete_from_animal (animal $animal) : void
    {
        global $mysqli_connection;

        $sql = "
            DELETE FROM animal
            WHERE id = {$animal->get_id()}
        ";

        if ($mysqli_connection->query($sql)) {
            /* do nothing */;
        }
        else {
            throw new Exception("Deletion failed");
        }
    }

     public static function select_all_animal_join_specie () : array
     {
         $all_animals_joined = [];

         $all_animals = database::select_all_animal();

         foreach ($all_animals as $animal) {
             $specie = database::select_specie_by_id($animal->get_specie_id());
             $animal_joined = new animal_join_specie($animal, $specie);
             array_push($all_animals_joined, $animal_joined);
         }

         return $all_animals_joined;
     }

     public static function select_latest_event_id () : ?int
     {
         global $mysqli_connection;

         $sql = "
             SELECT id
             FROM event
             ORDER BY id DESC
             LIMIT 1;
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id = (int) $record["id"];
             return $id;
         }
         else {
             return null;
         }
     }

     public static function insert_into_event (event $event) : void
     {
         global $mysqli_connection;

         $kids_only = (int) $event->get_kids_only();
         $name          = $mysqli_connection->real_escape_string($event->get_name());
         $description   = $mysqli_connection->real_escape_string($event->get_description());
         $image_url     = $mysqli_connection->real_escape_string($event->get_image_url());
         $starting_time = $mysqli_connection->real_escape_string($event->get_starting_time());

         $sql = "
             INSERT INTO event (id, kids_only, name, description, image_url, starting_time)
             VALUES ( {$event->get_id()}
                    , {$kids_only}
                    , '{$name}'
                    , '{$description}'
                    , '{$image_url}'
                    , '{$starting_time}'
                    )
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Insertion failed");
         }
     }

     public static function select_all_event () : array
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, kids_only, name, description, image_url, starting_time
             FROM event
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_events = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id            = (int) $record["id"];
                 $kids_only     = (bool) $record["kids_only"];
                 $name          = stripslashes($record["name"]);
                 $description   = stripslashes($record["description"]);
                 $image_url     = stripslashes($record["image_url"]);
                 $starting_time = stripslashes($record["starting_time"]);

                 $event = new event($id, $kids_only, $name, $description, $image_url, $starting_time);
                 array_push($all_events, $event);
             }
         }

         return $all_events;
     }

     public static function select_upcoming_event (string $datetime) : array
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, kids_only, name, description, image_url, starting_time
             FROM event
             WHERE starting_time > '$datetime'
             ORDER BY starting_time ASC
         ";

         $result_set = $mysqli_connection->query($sql);

         $selected_events = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id            = (int) $record["id"];
                 $kids_only     = (bool) $record["kids_only"];
                 $name          = stripslashes($record["name"]);
                 $description   = stripslashes($record["description"]);
                 $image_url     = stripslashes($record["image_url"]);
                 $starting_time = stripslashes($record["starting_time"]);

                 $event = new event($id, $kids_only, $name, $description, $image_url, $starting_time);
                 array_push($selected_events, $event);
             }
         }

         return $selected_events;
     }

     public static function select_all_event_order_by_starting_time () : array
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, kids_only, name, description, image_url, starting_time
             FROM event
             ORDER BY starting_time ASC
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_events = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id            = (int) $record["id"];
                 $kids_only     = (bool) $record["kids_only"];
                 $name          = stripslashes($record["name"]);
                 $description   = stripslashes($record["description"]);
                 $image_url     = stripslashes($record["image_url"]);
                 $starting_time = stripslashes($record["starting_time"]);

                 $event = new event($id, $kids_only, $name, $description, $image_url, $starting_time);
                 array_push($all_events, $event);
             }
         }

         return $all_events;
     }

     public static function select_event_by_id (int $id) : ?event
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, kids_only, name, description, image_url, starting_time
             FROM event
             WHERE id={$id}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);

             $id            = (int) $record["id"];
             $kids_only     = (bool) $record["kids_only"];
             $name          = stripslashes($record["name"]);
             $description   = stripslashes($record["description"]);
             $image_url     = stripslashes($record["image_url"]);
             $starting_time = stripslashes($record["starting_time"]);

             $event = new event($id, $kids_only, $name, $description, $image_url, $starting_time);
             return $event;
         }
         else {
             return null;
         }
     }

     public static function update_event (event $event) : void
     {
         global $mysqli_connection;

         $kids_only = (int) $event->get_kids_only();
         $name          = $mysqli_connection->real_escape_string($event->get_name());
         $description   = $mysqli_connection->real_escape_string($event->get_description());
         $image_url     = $mysqli_connection->real_escape_string($event->get_image_url());
         $starting_time = $mysqli_connection->real_escape_string($event->get_starting_time());

         $sql = "
             UPDATE event
             SET kids_only     = {$kids_only},
                 name          = '{$name}',
                 description   = '{$description}',
                 image_url     = '{$image_url}',
                 starting_time = '{$starting_time}'
             WHERE id = {$event->get_id()}
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Update failed");
         }
     }

     public static function delete_from_event (event $event) : void
     {
         global $mysqli_connection;

         $sql = "
             DELETE FROM event
             WHERE id = {$event->get_id()}
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Deletion failed");
         }
     }

     public static function select_latest_visitor_id () : ?int
     {
         global $mysqli_connection;

         $sql = "
             SELECT id
             FROM visitor
             ORDER BY id DESC
             LIMIT 1;
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id = (int) $record["id"];
             return $id;
         }
         else {
             return null;
         }
     }

     public static function select_visitor_by_username (string $username) : ?visitor
     {
         global $mysqli_connection;

         $sql = "
            SELECT id, fullname, username, password, email, phone, birthday
            FROM visitor
            WHERE username = '{$username}'
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);

             $id       = (int) $record["id"];
             $fullname = stripslashes($record["fullname"]);
             $username = stripslashes($record["username"]);
             $password = stripslashes($record["password"]);
             $email    = stripslashes($record["email"]);
             $phone    = stripslashes($record["phone"]);
             $birthday = stripslashes($record["birthday"]);

             $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
             return $visitor;
         }
         else {
             return null;
         }
     }

     public static function select_visitor_by_email (string $email) : ?visitor
     {
         global $mysqli_connection;

         $sql = "
            SELECT id, fullname, username, password, email, phone, birthday
            FROM visitor
            WHERE email = '{$email}'
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);

             $id       = (int) $record["id"];
             $fullname = stripslashes($record["fullname"]);
             $username = stripslashes($record["username"]);
             $password = stripslashes($record["password"]);
             $email    = stripslashes($record["email"]);
             $phone    = stripslashes($record["phone"]);
             $birthday = stripslashes($record["birthday"]);

             $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
             return $visitor;
         }
         else {
             return null;
         }
     }

     public static function select_visitor_by_phone (string $phone) : ?visitor
     {
         global $mysqli_connection;

         $sql = "
            SELECT id, fullname, username, password, email, phone, birthday
            FROM visitor
            WHERE phone = '{$phone}'
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);

             $id       = (int) $record["id"];
             $fullname = stripslashes($record["fullname"]);
             $username = stripslashes($record["username"]);
             $password = stripslashes($record["password"]);
             $email    = stripslashes($record["email"]);
             $phone    = stripslashes($record["phone"]);
             $birthday = stripslashes($record["birthday"]);

             $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
             return $visitor;
         }
         else {
             return null;
         }
     }

     public static function select_visitor_by_id (int $id) : ?visitor
     {
         global $mysqli_connection;

         $sql = "
            SELECT id, fullname, username, password, email, phone, birthday
            FROM visitor
            WHERE id = {$id}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);

             $id       = (int) $record["id"];
             $fullname = stripslashes($record["fullname"]);
             $username = stripslashes($record["username"]);
             $password = stripslashes($record["password"]);
             $email    = stripslashes($record["email"]);
             $phone    = stripslashes($record["phone"]);
             $birthday = stripslashes($record["birthday"]);

             $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
             return $visitor;
         }
         else {
             return null;
         }
     }

     public static function insert_into_visitor (visitor $visitor) : void
     {
         global $mysqli_connection;

         $fullname = $mysqli_connection->real_escape_string($visitor->get_fullname());
         $username = $mysqli_connection->real_escape_string($visitor->get_username());
         $hashed_password = password_hash($visitor->get_password(), PASSWORD_DEFAULT);
         $email    = $mysqli_connection->real_escape_string($visitor->get_email());
         $phone    = $mysqli_connection->real_escape_string($visitor->get_phone());
         $birthday = $mysqli_connection->real_escape_string($visitor->get_birthday());

         $sql = "
             INSERT INTO visitor (id, fullname, username, password, email, phone, birthday)
             VALUES ( {$visitor->get_id()}
                    , '{$fullname}'
                    , '{$username}'
                    , '{$hashed_password}'
                    , '{$email}'
                    , '{$phone}'
                    , '{$birthday}'
                    )
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Insertion failed");
         }
     }

     public static function update_visitor (visitor $visitor) : void
     {
         global $mysqli_connection;

         $fullname = $mysqli_connection->real_escape_string($visitor->get_fullname());
         $username = $mysqli_connection->real_escape_string($visitor->get_username());
         $hashed_password = password_hash($visitor->get_password(), PASSWORD_DEFAULT);
         $email    = $mysqli_connection->real_escape_string($visitor->get_email());
         $phone    = $mysqli_connection->real_escape_string($visitor->get_phone());
         $birthday = $mysqli_connection->real_escape_string($visitor->get_birthday());

         $sql = "
             UPDATE visitor
             SET fullname = '{$fullname}',
                 username = '{$username}',
                 password = '{$hashed_password}',
                 email    = '{$email}',
                 phone    = '{$phone}',
                 birthday = '{$birthday}'
             WHERE id = {$visitor->get_id()}
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Update failed");
         }
     }

     public static function insert_into_attendance (attendance $attendance) : void
     {
         global $mysqli_connection;

         $sql = "
             INSERT INTO attendance (event_id, visitor_id)
             VALUES ( {$attendance->get_event_id()}
                    , {$attendance->get_visitor_id()}
                    )
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Insertion failed");
         }
     }

     public static function select_attendance_by_visitor_id (int $visitor_id) : array
     {
         global $mysqli_connection;

         $sql = "
            SELECT event_id, visitor_id
            FROM attendance
            WHERE visitor_id = {$visitor_id}
         ";

         $selected_attendances = [];

         $result_set = $mysqli_connection->query($sql);

         while ($record = mysqli_fetch_assoc($result_set)) {
             $event_id   = (int) $record["event_id"];
             $visitor_id = (int) $record["visitor_id"];

             $attendace = new attendance($event_id, $visitor_id);
             array_push($selected_attendances, $attendace);
         }

         return $selected_attendances;
     }

     public static function select_attendance_join_event_by_visitor_id (int $visitor_id) : array
     {
         $attendaces_matched_visitor_id = database::select_attendance_by_visitor_id($visitor_id);

         $all_attendances_joined = [];

         foreach ($attendaces_matched_visitor_id as $attendance) {
             $event = database::select_event_by_id($attendance->get_event_id());
             $attendance_joined = new attendance_join_event($attendance, $event);
             array_push($all_attendances_joined, $attendance_joined);
         }

         return $all_attendances_joined;
     }

     public static function select_all_visitor () : array
     {
         global $mysqli_connection;

         $sql = "
            SELECT id, fullname, username, password, email, phone, birthday
            FROM visitor
         ";

         $all_visitors = [];

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id       = (int) $record["id"];
                 $fullname = stripslashes($record["fullname"]);
                 $username = stripslashes($record["username"]);
                 $password = stripslashes($record["password"]);
                 $email    = stripslashes($record["email"]);
                 $phone    = stripslashes($record["phone"]);
                 $birthday = stripslashes($record["birthday"]);

                 $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
                 array_push($all_visitors, $visitor);
             }
         }

         return $all_visitors;
     }

     public static function select_all_attendance_order_by_event_id_desc () : array
     {
         global $mysqli_connection;

         $sql = "
            SELECT event_id, visitor_id
            FROM attendance
            ORDER BY event_id DESC
         ";

         $all_attendances = [];

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $event_id   = (int) $record["event_id"];
                 $visitor_id = (int) $record["visitor_id"];

                 $attendance = new attendance($event_id, $visitor_id);
                 array_push($all_attendances, $attendance);
             }
        }

         return $all_attendances;
     }

     public static function select_all_attendance_join_event_join_visitor_order_by_event_id_desc () : array
     {
         $all_attendances = database::select_all_attendance_order_by_event_id_desc();

         $all_attendances_joined = [];

         foreach ($all_attendances as $attendance) {
             $event = database::select_event_by_id($attendance->get_event_id());
             $visitor = database::select_visitor_by_id($attendance->get_visitor_id());
             $attendance_joined = new attendance_join_event_join_visitor($attendance, $event, $visitor);
             array_push($all_attendances_joined, $attendance_joined);
         }

         return $all_attendances_joined;
     }

     public static function select_all_page () : array
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, menu_name, title, body_text, `order`, slug
             FROM page
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_pages = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id        = (int) $record["id"];
                 $menu_name = stripslashes($record["menu_name"]);
                 $title     = stripslashes($record["title"]);
                 $body_text = stripslashes($record["body_text"]);
                 $order     = (int) $record["order"];
                 $slug      = stripslashes($record["slug"]);

                 $page = new page($id, $menu_name, $title, $body_text, $order, $slug);
                 array_push($all_pages, $page);
             }
         }

         return $all_pages;
     }

     public static function select_latest_page_id () : ?int
     {
         global $mysqli_connection;

         $sql = "
             SELECT id
             FROM page
             ORDER BY id DESC
             LIMIT 1;
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id = (int) $record["id"];
             return $id;
         }
         else {
             return null;
         }
     }

     public static function insert_into_page (page $page) : void
     {
         global $mysqli_connection;

         $menu_name = $mysqli_connection->real_escape_string($page->get_menu_name());
         $title     = $mysqli_connection->real_escape_string($page->get_title());
         $body_text = $mysqli_connection->real_escape_string($page->get_body_text());
         $slug      = $mysqli_connection->real_escape_string($page->get_slug());

         $sql = "
             INSERT INTO page (id, menu_name, title, body_text, `order`, slug)
             VALUES ( {$page->get_id()}
                    , '{$menu_name}'
                    , '{$title}'
                    , '{$body_text}'
                    , {$page->get_order()}
                    , '{$slug}'
                    )
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Insertion failed");
         }
     }

     public static function select_page_by_order (int $order) : ?page
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, menu_name, title, body_text, `order`, slug
             FROM page
             WHERE `order` = {$order}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id        = (int) $record["id"];
             $menu_name = stripslashes($record["menu_name"]);
             $title     = stripslashes($record["title"]);
             $body_text = stripslashes($record["body_text"]);
             $order     = (int) $record["order"];
             $slug      = stripslashes($record["slug"]);

             $page = new page($id, $menu_name, $title, $body_text, $order, $slug);
             return $page;
         }
         else {
             return null;
         }
     }

     public static function select_page_by_id (int $id) : ?page
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, menu_name, title, body_text, `order`, slug
             FROM page
             WHERE id = {$id}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id        = (int) $record["id"];
             $menu_name = stripslashes($record["menu_name"]);
             $title     = stripslashes($record["title"]);
             $body_text = stripslashes($record["body_text"]);
             $order     = (int) $record["order"];
             $slug      = stripslashes($record["slug"]);

             $page = new page($id, $menu_name, $title, $body_text, $order, $slug);
             return $page;
         }
         else {
             return null;
         }
     }

     public static function select_page_by_slug (string $slug) : ?page
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, menu_name, title, body_text, `order`, slug
             FROM page
             WHERE slug = '{$slug}'
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id        = (int) $record["id"];
             $menu_name = stripslashes($record["menu_name"]);
             $title     = stripslashes($record["title"]);
             $body_text = stripslashes($record["body_text"]);
             $order     = (int) $record["order"];
             $slug      = stripslashes($record["slug"]);

             $page = new page($id, $menu_name, $title, $body_text, $order, $slug);
             return $page;
         }
         else {
             return null;
         }
     }

     public static function update_page (page $page) : void
     {
         global $mysqli_connection;

         $menu_name = $mysqli_connection->real_escape_string($page->get_menu_name());
         $title     = $mysqli_connection->real_escape_string($page->get_title());
         $body_text = $mysqli_connection->real_escape_string($page->get_body_text());
         $slug      = $mysqli_connection->real_escape_string($page->get_slug());

         $sql = "
             UPDATE page
             SET menu_name = '{$menu_name}',
                 title     = '{$title}',
                 body_text = '{$body_text}',
                 `order`   = {$page->get_order()},
                 slug      = '{$slug}'
             WHERE id = {$page->get_id()}
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Update failed");
         }
     }

     public static function delete_from_page (page $page) : void
     {
         global $mysqli_connection;

         $sql = "
             DELETE FROM page
             WHERE id = {$page->get_id()}
         ";

         if ($mysqli_connection->query($sql)) {
             /* do nothing */;
         }
         else {
             throw new Exception("Deletion failed");
         }
     }

     public static function select_all_page_order_by_order () : array
     {
         global $mysqli_connection;

         $sql = "
             SELECT id, menu_name, title, body_text, `order`, slug
             FROM page
             ORDER BY `order`
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_pages = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id        = (int) $record["id"];
                 $menu_name = stripslashes($record["menu_name"]);
                 $title     = stripslashes($record["title"]);
                 $body_text = stripslashes($record["body_text"]);
                 $order     = (int) $record["order"];
                 $slug      = stripslashes($record["slug"]);

                 $page = new page($id, $menu_name, $title, $body_text, $order, $slug);
                 array_push($all_pages, $page);
             }
         }

         return $all_pages;
     }
} // class

?>
