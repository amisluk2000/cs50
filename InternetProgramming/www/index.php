<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
        <?php function GetInfo ($Category)
		 {
             
             mysql_connect("localhost", "root", "") or
                die("Could not connect: " . mysql_error());
             mysql_select_db("internetprogramming");
             if($Category=="Tech" || $Category=="Politician"  || $Category=="Sport" || $Category=="Music")
             {
			     $sql="SELECT * FROM `information` WHERE `Category` = '$Category'";
             }
             else
             {
                 $sql="SELECT * FROM `information` WHERE `Date` = '$Category'";
             }
             $result = mysql_query($sql);
			 while($row = mysql_fetch_array($result,MYSQL_ASSOC))
			 {
				 echo "<h2>".$row['Date']."</h2><br>";
				 echo '<img height="150" src="data:image/jpeg;base64,',base64_encode($row['Image']),'" /><br />';
				 echo "<p>".$row['Text']."</p>";
				 echo "<hr>";				 
			 }			 
		 }
            function GetRandomImg()
            {
                mysql_connect("localhost", "root", "") or
                die("Could not connect: " . mysql_error());
                mysql_select_db("internetprogramming");
                $range_result = mysql_query( " SELECT MAX(`ID`) AS max_id , MIN(`ID`) AS min_id FROM `Information` ");
                $range_row = mysql_fetch_object( $range_result );
                $random = mt_rand( $range_row->min_id , $range_row->max_id );
                $result = mysql_query( " SELECT * FROM `Information` WHERE `ID` >= $random LIMIT 0,1 ");
                $row = mysql_fetch_array($result,MYSQL_ASSOC);
                 echo '<img height="150" src="data:image/jpeg;base64,',base64_encode($row['Image']),'" /><br />';               
            }
            function IncrementCounter($Path)
            {
                $fp=fopen($Path,"r");
                $num = fread($fp, filesize($Path));
                fclose($fp);
                $fp=fopen($Path,"w");                                
                $num=intval($num)+1;
                fwrite($fp,$num);
                fclose($fp);
                
            }
            function ShowCounter($Path)
            {
                $fp=fopen($Path,"r");
                $num = fread($fp, filesize($Path));
                echo '<center style="font-weight: bold; font-size: 5vh; color:white;">'.'Counter:'.$num."</center>";
                fclose($fp);
            }
         ?>
    </head>
    <body onload="<?php IncrementCounter("counter.txt");?>">
        <div id="wrapper">
            
            <div id="logo">
                <font style="font-size:24px;">COMPANY</font>
                <font style="font-size:36px; letter-spacing: 7px">LOGO</font>
            </div>
            <form><input type="text" name="type" placeholder="Введите название статьи"><input type="submit"></form>
            <div id="PapperBg">
            </div>
            <div id="header">
                <div id="leftlogo">
                    <h1>YE OLD</h1>
                    <hr>
                    Monday 1st October
                </div>
                <div id="headlogo">
                    <p>The</p>
                    <p>EST. 1857</p>
                </div>
                <div id="rightlogo">
                    <h1>NEWSPAPPER</h1>
                    <hr>
                    Old Meldrum, Aberdeenshire
                </div>
            </div>
                <div id="nav">
                    <ul>
                        <li><a href="?type=Tech">Technology</a></li>
                        <li><a href="?type=Politician">Politician</a></li>
                        <li><a href="?type=Sport">Sport</a></li>
                        <li><a href="?type=Music">Music</a></li>
                    </ul>
                </div>
                <div id="content">
                    <?php GetInfo($_GET['type']); ?>
                </div>
                <div class="additional" id="add1"><?php GetRandomImg(); ?></div>
                <div class="additional" id="add2"><?php GetRandomImg(); ?></div>
                <div class="additional"  id="add3"><?php GetRandomImg(); ?></div>
            <div id="footer">
                <table rows="2" cols="1" style="border: 1px solid white; border-radius:5px; margin-left:40px; color:white;">
                    <tr><td>Счётчик</td></tr>
                    <tr><td><?php ShowCounter("counter.txt"); ?></td></tr>
                    <script type="text/javascript">
                      var h= document.getElementById('content').offsetHeight;
                      h+= document.getElementById('header').offsetHeight; 
                      h+= document.getElementById('nav').offsetHeight;       
                      h+= document.getElementById('logo').offsetHeight;
                      h-=30;                                                                        
                      document.getElementById('wrapper').style.height = h.toString()+'px';
                      document.getElementById('PapperBg').style.height = h.toString()+'px';                      
    
                    </script>
                </table>
            </div>
        </div>
        
    </body>
</html>