<?php 
session_start(); 
include('..\connect.php'); 
include('..\customer\cus_header.php');

?>
<style type="text/css">
    .price
    {
        color: #ffffff;
        background: #3366ff;
        font-size: 16pt;
        font-family:Century Gothic;
        padding: 10px;
    }

    .detail
    {
        color: #ffffff;
        background: #3366ff;
        font-size: 12pt;
        font-family:Century Gothic;
        padding: 10px;
    }

    .price:hover
    {
        color: #000;
        background: #CCC;
        font-size: 20pt;
        font-family:Century Gothic;
        padding: 10px;
    }
    .detail:hover
    {
        color: #000;
        background: #CCC;
        font-size: 20pt;
        font-family:Century Gothic;
        padding: 10px;
    }
</style>
<form action="merchandise_display.php" method="post">
    <fieldset>
        <div class="contact" id="contact">
            <div class="container">
                <div class="contact-block">
                    <h3 class="title clr">Available Merchandises</h3>
                    <legend>Explore Merchandises :</legend>
                    <table width="100%">
                        <tr>
                            <td align="right">
                                <input type="text" name="txtData" placeholder="Enter Search Keywords" />
                                <input type="submit" name="btnSearch" value="Search" />
                            </td>
                        </tr>
                    </table>
                    <hr/>

                    <table cellpadding="5px" width="100%">
                        <?php  

                        if(isset($_POST['btnSearch'])) 
                        {
                            $txtData=$_POST['txtData'];

                            $query1="SELECT * FROM merchandise
                            WHERE Merchandise_Name LIKE '%$txtData%'
                            OR Price='$txtData'
                            ";
                            $ret1=mysqli_query($connection,$query1);
                            $count1=mysqli_num_rows($ret1);

                            for($i=0;$i<$count1;$i+=4) 
                            { 
                                $query2="SELECT * FROM merchandise
                                WHERE Merchandise_Name LIKE '%$txtData%'
                                OR Price='$txtData'
                                LIMIT $i,4
                                ";
                                $ret2=mysqli_query($connection,$query2);
                                $count2=mysqli_num_rows($ret2);

                                echo "<tr>";
                                for($x=0;$x<$count2;$x++) 
                                { 
                                    $row=mysqli_fetch_array($ret1);

                                    $MerchandiseID=$row['MerchandiseID'];
                                    $Merchandise_Name=$row['Merchandise_Name'];
                                    $Price=$row['Price'];
                                    $Image=$row['Photo1'];

                                    list($width,$height)=getimagesize($Image);
                                    $w=$width/2.5;
                                    $h=$height/2.5;
                                    ?>
                                    <td align="center">
                                        <img src="<?php echo $Image ?>" style="width: 150px; height: 150px;" />
                                        <hr/>
                                        <b><?php echo $Merchandise_Name ?></b>
                                        <hr/>
                                        <b class="price"><?php echo $Price ?> MMK </b>
                                        <hr/>

                                        <a class="price" href="merchandise_detail.php?MerchandiseID=<?php echo $MerchandiseID ?>">details</a>

                                    </td>
                                    <?php
                                }
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            $query1="SELECT * FROM merchandise";
                            $ret1=mysqli_query($connection,$query1);
                            $count1=mysqli_num_rows($ret1);

                            for($i=0;$i<$count1;$i+=4) 
                            { 
                                $query2="SELECT * FROM merchandise LIMIT $i,4";
                                $ret2=mysqli_query($connection,$query2);
                                $count2=mysqli_num_rows($ret2);

                                echo "<tr>";
                                for($x=0;$x<$count2;$x++) 
                                { 
                                    $row=mysqli_fetch_array($ret2);

                                    $MerchandiseID=$row['MerchandiseID'];
                                    $Merchandise_Name=$row['Merchandise_Name'];
                                    $Price=$row['Price'];
                                    $Image=$row['Photo1'];

                                    list($width,$height)=getimagesize($Image);
                                    $w=$width/2.5;
                                    $h=$height/2.5;
                                    ?>
                                    <td align="center">
                                        <img src="<?php echo $Image ?>" style="width: 150px; height: 150px;" />
                                        <hr/>
                                        <b><?php echo $Merchandise_Name ?></b>
                                        <hr/>
                                        <b class="price"><?php echo $Price ?> MMK </b>
                                        <hr/>
                                        <a class="detail" href="merchandise_detail.php?MerchandiseID=<?php echo $MerchandiseID ?>">details</a>
                                    </td>
                                    <?php
                                }
                                echo "</tr>";
                            }
                        }

                        ?>
                    </table>

                    
                </div>
            </div>
        </div>
    </fieldset>
</form>
<?php
include('..\footer.php');
?>