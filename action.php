<?php
session_start();

if (isset($_GET['action']))
{
    if (isset($_GET['item']))
    {
        if ($_GET['action'] == 'updateStatus')
        {
            include 'conn.php';
            $id = $_GET['item'];

            include 'conn.php';
            // Update item to complete
            $sql = "UPDATE `georescue` SET `status`='Complete' WHERE `id`='" . $id . "'";

            // try to connect and send SQL query with details
            // if unable return error
            try
            {
                $pdo = new PDO($dsn, $username, $password);
                $stmt = $pdo->query($sql);
                if ($stmt === false)
                {
                    $_SESSION['errorMessage'] = "Failed to connect to the database.";
                    Header('Location: index.php?code=error');
                }
                else
                {
                    $_SESSION['successMessage'] = "Successfully updated the status.";
                    Header('Location: index.php?code=success');
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        if ($_GET['action'] == 'deleteItem')
        {
            include 'conn.php';
            $id = $_GET['item'];

            include 'conn.php';
            // Update item to complete
            $sql = "DELETE FROM `georescue` WHERE `id`='" . $id . "'";

            // try to connect and send SQL query with details
            // if unable return error
            try
            {
                $pdo = new PDO($dsn, $username, $password);
                $stmt = $pdo->query($sql);
                if ($stmt === false)
                {
                    $_SESSION['errorMessage'] = "Failed to connect to the database.";
                    Header('Location: index.php?code=error');
                }
                else
                {
                    $_SESSION['successMessage'] = "Successfully deleted the item.";
                    Header('Location: index.php?code=success');
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
    }
}

?>
