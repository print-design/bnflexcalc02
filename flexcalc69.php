<?php
    if (isset($_REQUEST['a']))
    { 


          $a = $_REQUEST['a'];
          $c = $_REQUEST['c']; 
          $d1 = $_REQUEST['d1']; 
          $d2 = $_REQUEST['d2']; 

          $d3 = $_REQUEST['d3']; 
          $d4 = $_REQUEST['d4']; 
          $d5 = $_REQUEST['d5'];

          $d6 = $_REQUEST['d6'];

          $d7 = $_REQUEST['d7'];
          $d8 = $_REQUEST['d8'];
          $d9 = $_REQUEST['d9'];
          $e1 = $_REQUEST['e1'];

          $e2 = $_REQUEST['e2'];
          $e3 = $_REQUEST['e3'];
          $e4 = $_REQUEST['e4'];
          $e5 = $_REQUEST['e5'];
          $e6 = $_REQUEST['e6'];
          $e7 = $_REQUEST['e7'];
          $e8 = $_REQUEST['e8'];
          $e9 = $_REQUEST['e9'];

          $f1 = $_REQUEST['f1'];

          $f2 = $_REQUEST['f2'];
          $f3 = $_REQUEST['f3'];
          $f4 = $_REQUEST['f4'];
          $f5 = $_REQUEST['f5'];
          $f6 = $_REQUEST['f6'];
          $f7 = $_REQUEST['f7'];
          $f8 = $_REQUEST['f8'];
          $f9 = $_REQUEST['f9'];

          //------------------------------------------------------------------------------ 

          //номер записи в таблице базы для выборки данных 
          $qr_id=$a;

          // определяем начальные данные 
          $db_host = 'localhost';  //путь к серверу
          $db_name = 'bnexample1'; //база
          $db_username = 'root';
          $db_password = '123456';
          $db_table_to_show = 'flexcalculation1'; //таблица в базе

          // соединяемся с сервером базы данных
          $connect_to_db = mysql_connect($db_host, $db_username, $db_password)
          or die("Could not connect: " . mysql_error());

          // подключаемся к базе данных
          mysql_select_db($db_name, $connect_to_db)
          or die("Could not select DB: " . mysql_error());

          mysql_set_charset("utf8");

          //-------------------------------------------------------
          if ($c==4)
          {
            //удаление записи с $qr_id=$a;

            $query_delete ="DELETE FROM $db_table_to_show WHERE id in ($qr_id)";            

            mysql_query ($query_delete);

            //Пересчет (сквозная нумерация после удаления строки) id таблицы 
            //(для одной таблицы не связанной с другими таблицы базы!)
            //(для связанных таблиц лучше оставить ID как есть, т.е, например,
            // было в таблице ID=1,2,3,4,5,6,7, после удаления строки с ID=3, будет
            // в базе (таблице) ID=1,2,4,5,6,7, что важно для связанных таблиц в базе)

            //Пример из SQL запросов
            //ALTER TABLE `table_name` MODIFY `id` INT(11); 
            //ALTER TABLE `table_name` DROP PRIMARY KEY; 
            //UPDATE `table_name` SET `id`='0'; 
            //ALTER TABLE `table_name` AUTO_INCREMENT=1; 
            //ALTER TABLE `table_name` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;

            //Пример сброса ID  в php mysql - возобновление сквозной нумерации
            //после удаления любой строки. Помни, ID строк теперь пронумерованы
            //подряд с первой по последнюю, т.е ID строк изменилось ! 
            $query_auto1 ="ALTER TABLE $db_table_to_show MODIFY `ID` INT(11)";
            mysql_query ($query_auto1);
            $query_auto2 ="ALTER TABLE $db_table_to_show DROP PRIMARY KEY"; 
            mysql_query ($query_auto2);
            $query_auto3 ="UPDATE $db_table_to_show SET `ID`='0'";
            mysql_query ($query_auto3);
            $query_auto4 ="ALTER TABLE $db_table_to_show AUTO_INCREMENT=1"; 
            mysql_query ($query_auto4); 
            $query_auto5 ="ALTER TABLE $db_table_to_show MODIFY `ID` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY";
            mysql_query ($query_auto5);
          };

          //-------------------------------------------------------
          if ($c==3)
          {
            //сохранить в базе данные c $qr_id=$a;
            $query_save = "UPDATE $db_table_to_show SET `Менеджер` = '$d1', 
                                                        `Дата` = '$d2',
                                                        `Наименование заказа` = '$d3',
                                                        `Тип бумаги, пленки` = '$d4',
                                                        `Ширина этикетки (мм2)` = '$d5',
                                                        `Высота этикетки (мм2)` = '$d6',
                                                        `Общее количество этикеток (тираж)` = '$d7',
                                                        `Количество этикеток на валу` = '$d8',
                                                        `Красочность (число красок)` = '$d9',
                                                        `Рапорт вала (мм)` = '$e1',
                                                        `Ширина роля бумаги (мм)` = '$e2',
                                                        `Цена бумаги за м2` = '$e3',
                                                        `Формы` = '$e4',
                                                        `Стоимость бумаги вместе с приладкой (руб)` = '$e5',
                                                        `Стоимость пленок (руб)` = '$e6',
                                                        `Стоимость форм (руб)` = '$e7',
                                                        `Стоимость тиража (руб)` = '$e8',
                                                        `Погонные метры плюс приладка (м)` = '$e9',
                                                        `Квадратные метры (м2)` = '$f1',
                                                        `Площадь этикетки (мм2)` = '$f2',
                                                        `Итого, себестоимость (руб)` = '$f3',
                                                        `Прибыль (%)` = '$f4',
                                                        `Прибыль (руб)` = '$f5',
                                                        `Общая стоимость (руб)` = '$f6',
                                                        `Цена за этикетку (руб)` = '$f7',
                                                        `Общее количество этикеток (штук)` = '$f8',
                                                        `Рентабельность (%)` = '$f9'

                           WHERE id in ($qr_id)";

            mysql_query ($query_save);
          };

          //-------------------------------------------------------
          if ($c==2)
          {
            //добавление новой записи
            $query_insert = "INSERT INTO $db_table_to_show VALUES ('0','New Menedjer', '2019-05-09','New Product','Plenka','70','80','1000','12','3','217.3',
                                      '500','3.5','1','0','0','0','0','0','0','0',
                                      '0','0','0','0','0','0','0')";
            mysql_query ($query_insert);
          };

          //-------------------------------------------------------
          if ($c==1)
          {
             //выбор записи с $qr_id=$a;

             // определяем число строк (записей) в таблице
             $get_num_str = mysql_query("SELECT COUNT(*) FROM $db_table_to_show") or die(mysql_error());
             $num_str = mysql_fetch_array( $get_num_str );
             //в $num_str['0'] содержится число строк в таблице  


             //запрос на выборку данных
             $qr_result = mysql_query("SELECT * FROM $db_table_to_show WHERE id in ($qr_id) LIMIT 1") or die(mysql_error());

             //считываем  данные
             $data=mysql_fetch_array($qr_result);
         
          
             //соответсвие полей в таблице считанным данным (коментарии) 
             //$numzapisibaza =     $data['0'];
             //$menedjer =          $data['1'];
             //$bazadata =          $data['2'];
             //$naimzakaza =        $data['3'];
             //$tipbumagi =         $data['4'];
             //$ewidth =            $data['5'];

             //$eheigt =            $data['6'];
             //$tiraj =             $data['7'];
             //$numetikval =        $data['8'];
             //$numcolor =          $data['9'];
             //$raport =            $data['10'];

             //$widthrol =          $data['11'];
             //$costpaper =         $data['12'];
             //$formy =             $data['13'];
             //$costpaperprilad =   $data['14'];
             //$costplenok =        $data['15'];
 
             //$costform =          $data['16'];
             //$costtiraj =         $data['17'];
             //$pogonetripriladka = $data['18'];
             //$kvadratmetri =      $data['19'];
             //$plojadetiketki =    $data['20'];

             //$itogo =             $data['21'];
             //$pribilproc =        $data['22'];
             //$pribilrub =         $data['23'];
             //$allcost =           $data['24'];
             //$etikcost =          $data['25'];
             //$alletiketok =       $data['26'];
             //$rentab =            $data['27'];

             //массив для передачи данных
             //$myArr = array($GLOBALS['menedjer'], $GLOBALS['tiraj'], $GLOBALS['numcolor'], $GLOBALS['numetikval']);
             $myArr = array($data['0'], $data['1'],$data['2'],$data['3'],$data['4'],$data['5'],$data['6'],
                            $data['7'],$data['8'],$data['9'],$data['10'],$data['11'],$data['12'],$data['13'],$data['14'],
                            $data['15'],$data['16'],$data['17'],$data['18'],$data['19'],$data['20'],$data['21'],$data['22'],
                            $data['23'],$data['24'],$data['25'],$data['26'],$data['27'],$num_str['0']);

             //кодируем данные в формат JSON
             //$myJSON = json_encode($data);
             $myJSON = json_encode($myArr);

             //отправляем клиенту запрошенные данные
             echo $myJSON;
          };

          //-----------------------------------------------------------------------------
          // закрываем соединение с сервером  базы данных
          mysql_close($connect_to_db);
    }
    else echo "table id not set !";

?>