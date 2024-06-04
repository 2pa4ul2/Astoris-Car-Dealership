<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/update.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="assets/images/astorisfav.png" />
    <title>Astoris</title>
</head>
<body>
    <main>
        <div class="container">
            <div class="content-btn">
                    <h1 class="tab-btn-secondary">Update Supplier</h1>
            </div>    


            <div class="content-box">
                <div class="content">
                        <div>
                            <?php include "../includes/update.php"?>
                            <form action="../includes/supplier.php?new_supplier_id=<?php echo $supplier_id;?>" name="form_type" method="post">
                                <div class="input-container">
                                    <label for="supplier_name">Supplier Name</label>
                                    <input class="form-input" type="text" name="supplier_name" value="<?php echo $row['supplier_name'] ?>">
                                    <label for="contact_person">Contact Person</label>
                                    <input class="form-input" type="text" name="contact_person" value="<?php echo $row['contact_person'] ?>">
                                    <label for="contact_number">Contact Number</label>
                                    <input class="form-input" type="number" name="contact_number" value="<?php echo $row['contact_number'] ?>">
                                </div>
                                <div class="btn-container">
                                    <button class="submit-btn" name="update_supplier" value="Update">Submit</button> 
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </main>


</body>
</html>