<style>
    html,
    .root {
        padding: 0;
        margin: 0;
        font-size: 18px;
    }

    body {
        font: menu;
        font-size: 1rem;
        line-height: 1.4;
        padding: 0;
        margin: 0;
    }

    section {
        padding-top: 1rem;
        width: 50%;
        margin: auto;
    }

    h1 {
        font-size: 2rem;
        font-weight: 500;
    }

    details[open] summary~* {
        animation: open 0.3s ease-in-out;
    }

    @keyframes open {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    details summary::-webkit-details-marker {
        display: none;
    }

    details summary {
        width: 100%;
        padding: 0.5rem 0;
        border-top: 1px solid black;
        position: relative;
        cursor: pointer;
        font-size: 1.25rem;
        font-weight: 300;
        list-style: none;
    }

    details summary:after {
        content: "+";
        color: black;
        position: absolute;
        font-size: 1.75rem;
        line-height: 0;
        margin-top: 0.75rem;
        right: 0;
        font-weight: 200;
        transform-origin: center;
        transition: 200ms linear;
    }

    details[open] summary:after {
        transform: rotate(45deg);
        font-size: 2rem;
    }

    details summary {
        outline: 0;
    }

    details p {
        width: 100%;
        font-size: 0.95rem;
        margin: 0 0 1rem;
        line-break: anywhere;
    }
</style>
<?php
require("../../server.php");
$id = $_GET['id'];
$sql  = $connection->query("SELECT date, time, hostname,path,headers, http_method, description ,type,body FROM Detected_Attacks WHERE id='$id'");
$row = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Attack Details</title>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>
    <div>
        <section>
            <h1>
                Attack Details <i class='fas fa-user-secret' style='font-size:48px;color:red'></i>

            </h1>
            <details>

                <summary>Type</summary>
                <p>
                    <?php echo $row['type']; ?>
                </p>
            </details>
            <details>

                <summary>Date and Time</summary>
                <p>
                    <?php echo $row['date'] . " " . $row['time']; ?>
                </p>
            </details>
            <details>
                <summary>Method</summary>
                <p>
                    <?php echo $row['http_method']; ?>
                </p>
            </details>
            <details>
                <summary>URL
                </summary>
                <div>
                    <p>
                        <?php echo $row['hostname']; ?>
                    </p>
                </div>
            </details>
            <details>
                <summary>Path
                </summary>
                <p>
                    <?php echo  ($row['path']); ?>
                </p>
            </details>
            <details>
                <summary>Body
                </summary>
                <p>
                    <?php if (($row['body']) == null) {
                        echo "This request doesn't contain a body ";
                    } else {
                        echo ($row['body']);
                    } ?>
                </p>
            </details>
            <details>
                <summary>Headers
                </summary>
                <p>
                    <?php echo ($row['headers']); ?>
                </p>
            </details>
            <details>
                <summary>Description
                </summary>
                <p>
                    <?php echo $row['description']; ?>
                </p>
            </details>
        </section>
    </div>
</body>

</html>