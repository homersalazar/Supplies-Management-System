<?php 
require_once("../included/connection.php");
require_once("../included/header.php");
require_once("../included/navigation.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>
<div id="main" class="row">
<select id="userSelect">
    <option value="">Select User</option>
    <?php while($row = $result->fetch_assoc()){ ?>
    <option value="<?php echo $row['id']; ?>"><?php echo $row['fname']; ?></option>
    <?php } ?>
</select>

<!-- Print button -->
<button id="getUser">Print Details</button>

<!-- Hidden div to load the dynamic content -->
<div id="userInfo" style="display: none;"></div>
</div>
<script>
$(document).ready(function(){
    $('#getUser').on('click',function(){
        var userID = $('#userSelect').val();
        $('#userInfo').load('getData.php?id='+userID,function(){
            var printContent = document.getElementById('userInfo');
            var WinPrint = window.open('', '', 'width=900,height=650');
            WinPrint.document.write(printContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
    });
});
</script>
<?php
require_once("../included/footer.php");
?>