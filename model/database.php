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

        $sql = "
            INSERT INTO specie (id, name, description, image_url)
            VALUES ( {$specie->get_id()}
                   , '{$specie->get_name()}'
                   , '{$specie->get_description()}'
                   , '{$specie->get_image_url()}'
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
            SELECT id, name, description, image_url
            FROM specie
        ";

        $result_set = $mysqli_connection->query($sql);

        $all_species = [];

        if (mysqli_num_rows($result_set) > 0) {
            while ($record = mysqli_fetch_assoc($result_set)) {
                $id          = (int) $record["id"];
                $name        = $record["name"];
                $description = $record["description"];
                $image_url   = $record["image_url"];

                $specie = new specie($id, $name, $description, $image_url);
                array_push($all_species, $specie);
            }
        }

        return $all_species;
    }

    public static function select_specie_by_id (int $id) : ?specie
    {
        global $mysqli_connection;

        $sql = "
            SELECT id, name, description, image_url
            FROM specie
            WHERE id={$id}
        ";

        $result_set = $mysqli_connection->query($sql);

        if (mysqli_num_rows($result_set) > 0) {
            $record = mysqli_fetch_assoc($result_set);

            $id          = (int) $record["id"];
            $name        = $record["name"];
            $description = $record["description"];
            $image_url   = $record["image_url"];

            $specie = new specie($id, $name, $description, $image_url);
            return $specie;
        }
        else {
            return null;
        }
    }

    public static function update_specie (specie $specie) : void
    {
        global $mysqli_connection;

        $sql = "
            UPDATE specie
            SET name        = '{$specie->get_name()}',
                description = '{$specie->get_description()}',
                image_url   = '{$specie->get_image_url()}'
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

        $sql = "
            INSERT INTO animal (id, specie_id, name, description, image_url)
            VALUES ( {$animal->get_id()}
                   , {$animal->get_specie_id()}
                   , '{$animal->get_name()}'
                   , '{$animal->get_description()}'
                   , '{$animal->get_image_url()}'
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
                $name        = $record["name"];
                $description = $record["description"];
                $image_url   = $record["image_url"];

                $animal = new animal($id, $specie_id, $name, $description, $image_url);
                array_push($all_animals, $animal);
            }
        }

        return $all_animals;
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
            $name        = $record["name"];
            $description = $record["description"];
            $image_url   = $record["image_url"];

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

        $sql = "
            UPDATE animal
            SET specie_id   = {$animal->get_specie_id()},
                name        = '{$animal->get_name()}',
                description = '{$animal->get_description()}',
                image_url   = '{$animal->get_image_url()}'
            WHERE id = {$animal->get_id()}
        ";

        print($sql);

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
         $sql = "
             INSERT INTO event (id, kids_only, name, description, image_url, starting_time)
             VALUES ( {$event->get_id()}
                    , {$kids_only}
                    , '{$event->get_name()}'
                    , '{$event->get_description()}'
                    , '{$event->get_image_url()}'
                    , '{$event->get_starting_time()}'
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
                 $name          = $record["name"];
                 $description   = $record["description"];
                 $image_url     = $record["image_url"];
                 $starting_time = $record["starting_time"];

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
             $name          = $record["name"];
             $description   = $record["description"];
             $image_url     = $record["image_url"];
             $starting_time = $record["starting_time"];

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
         $sql = "
             UPDATE event
             SET kids_only     = {$kids_only},
                 name          = '{$event->get_name()}',
                 description   = '{$event->get_description()}',
                 image_url     = '{$event->get_image_url()}',
                 starting_time = '{$event->get_starting_time()}'
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
             $fullname = $record["fullname"];
             $username = $record["username"];
             $password = $record["password"];
             $email    = $record["email"];
             $phone    = $record["phone"];
             $birthday = $record["birthday"];

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
             $fullname = $record["fullname"];
             $username = $record["username"];
             $password = $record["password"];
             $email    = $record["email"];
             $phone    = $record["phone"];
             $birthday = $record["birthday"];

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
             $fullname = $record["fullname"];
             $username = $record["username"];
             $password = $record["password"];
             $email    = $record["email"];
             $phone    = $record["phone"];
             $birthday = $record["birthday"];

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
             $fullname = $record["fullname"];
             $username = $record["username"];
             $password = $record["password"];
             $email    = $record["email"];
             $phone    = $record["phone"];
             $birthday = $record["birthday"];

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

         $hashed_password = password_hash($visitor->get_password(), PASSWORD_DEFAULT);

         $sql = "
             INSERT INTO visitor (id, fullname, username, password, email, phone, birthday)
             VALUES ( {$visitor->get_id()}
                    , '{$visitor->get_fullname()}'
                    , '{$visitor->get_username()}'
                    , '{$hashed_password}'
                    , '{$visitor->get_email()}'
                    , '{$visitor->get_phone()}'
                    , '{$visitor->get_birthday()}'
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

         $hashed_password = password_hash($visitor->get_password(), PASSWORD_DEFAULT);

         $sql = "
             UPDATE visitor
             SET fullname = '{$visitor->get_fullname()}',
                 username = '{$visitor->get_username()}',
                 password = '{$hashed_password}',
                 email    = '{$visitor->get_email()}',
                 phone    = '{$visitor->get_phone()}',
                 birthday = '{$visitor->get_birthday()}'
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
                 $fullname = $record["fullname"];
                 $username = $record["username"];
                 $password = $record["password"];
                 $email    = $record["email"];
                 $phone    = $record["phone"];
                 $birthday = $record["birthday"];

                 $visitor = new visitor($id, $fullname, $username, $password, $email, $phone, $birthday);
                 array_push($all_visitors, $visitor);
             }
         }

         return $all_visitors;
     }

     public static function select_all_attendance_order_by_event_id_asc () : array
     {
         global $mysqli_connection;

         $sql = "
            SELECT event_id, visitor_id
            FROM attendance
            ORDER BY event_id ASC
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

     public static function select_all_attendance_join_event_join_visitor_order_by_event_id_asc () : array
     {
         $all_attendances = database::select_all_attendance_order_by_event_id_asc();

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
             SELECT id, menu_name, title, body_text, `order`
             FROM page
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_pages = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id        = (int) $record["id"];
                 $menu_name = $record["menu_name"];
                 $title     = $record["title"];
                 $body_text = $record["body_text"];
                 $order     = (int) $record["order"];

                 $page = new page($id, $menu_name, $title, $body_text, $order);
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

         $sql = "
             INSERT INTO page (id, menu_name, title, body_text, `order`)
             VALUES ( {$page->get_id()}
                    , '{$page->get_menu_name()}'
                    , '{$page->get_title()}'
                    , '{$page->get_body_text()}'
                    , {$page->get_order()}
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
             SELECT id, menu_name, title, body_text, `order`
             FROM page
             WHERE `order` = {$order}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id        = (int) $record["id"];
             $menu_name = $record["menu_name"];
             $title     = $record["title"];
             $body_text = $record["body_text"];
             $order     = (int) $record["order"];

             $page = new page($id, $menu_name, $title, $body_text, $order);
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
             SELECT id, menu_name, title, body_text, `order`
             FROM page
             WHERE id = {$id}
         ";

         $result_set = $mysqli_connection->query($sql);

         if (mysqli_num_rows($result_set) > 0) {
             $record = mysqli_fetch_assoc($result_set);
             $id        = (int) $record["id"];
             $menu_name = $record["menu_name"];
             $title     = $record["title"];
             $body_text = $record["body_text"];
             $order     = (int) $record["order"];

             $page = new page($id, $menu_name, $title, $body_text, $order);
             return $page;
         }
         else {
             return null;
         }
     }

     public static function update_page (page $page) : void
     {
         global $mysqli_connection;

         $sql = "
             UPDATE page
             SET menu_name = '{$page->get_menu_name()}',
                 title     = '{$page->get_title()}',
                 body_text = '{$page->get_body_text()}',
                 `order`   = {$page->get_order()}
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
             SELECT id, menu_name, title, body_text, `order`
             FROM page
             ORDER BY `order`
         ";

         $result_set = $mysqli_connection->query($sql);

         $all_pages = [];

         if (mysqli_num_rows($result_set) > 0) {
             while ($record = mysqli_fetch_assoc($result_set)) {
                 $id        = (int) $record["id"];
                 $menu_name = $record["menu_name"];
                 $title     = $record["title"];
                 $body_text = $record["body_text"];
                 $order     = (int) $record["order"];

                 $page = new page($id, $menu_name, $title, $body_text, $order);
                 array_push($all_pages, $page);
             }
         }

         return $all_pages;
     }
} // class

?>
