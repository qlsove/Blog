<?php

function changePost ($POST, $GET, $FILES, $categories, $links)
        {
        $id=$GET['chgId']; 
        $id=new MongoId($id);
        $nid=new MongoId();
        $time=$id->getTimestamp();

        $collection = connectDB();
        
        $search = $collection-> findOne(array('_id'=> $id));
    
                if(isset($POST['chgId']))
                        {
                        $id=$POST['chgId']; 
                        $id=new MongoId($id);
                        $time=$id->getTimestamp();
                        $check = getimagesize($FILES["file"]["tmp_name"]); 
                        $target_dir = "images/";
                        $search = $collection-> findOne(array('_id'=> $id));

                                if (null !== (basename($FILES["file"]["name"])))
                                    {
                                    $target_file = $target_dir.basename($FILES["file"]["name"]);
                                    move_uploaded_file($FILES["file"]["tmp_name"], $target_file); 
                                    }
                        /*$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )  
                                {
                                header( 'Location: /index.php?err=2', true);
                                }
                            else
                                {*/
                                 if ($target_file !='images/') 
                                        {  
                                         
                                        $info = pathinfo($target_file);
                                        $new_name = 'images/'.$search['_id'].'.'.$info['extension'];                   
                                        unlink($search['path']);
                                        rename($target_file, $new_name);
                                        $newdata = array('name' => $POST['name'],'body' => $POST['body'],'category' => $POST['category'], 'tags' => $POST['tags'],'id'=> $nid, 'time'=> $time, 'path'=> $new_name);     
                                        }
                                else
                                        {
                                        $newdata = array('name' => $POST['name'],'body' => $POST['body'],'category' => $POST['category'], 'tags' => $POST['tags'],'id'=> $nid, 'time'=> $time, 'path'=> $search['path']);
                                        }
                        
                        $collection->update(array('_id'=> $id), $newdata, array('upsert' => true));
    
                        header('Location: /index.php?adm=1', false);    
                              //  }    
                        } 
?> 
  
        <div class="add">
                <form name = "newPost" action="index.php" method = "POST"  autocomplete="off" enctype="multipart/form-data">
                        <p><textarea wrap="soft" style="width: 755px; height: 20px; resize: vertical" name="name" required ><?=$search['name']?></textarea></p>
                        <p><textarea style="width: 755px; height: 150px; resize: vertical" name="body" required ><?=$search['body']?></textarea></p>
                        <p><textarea wrap="soft"  placeholder="Перерахуйте при потребі теги до статті через пробіл" style="width: 755px; height: 25px; resize: vertical" name="tags"><?=$search['tags']?></textarea></p>
                        <input type="hidden" name="chgId" value="<?=$search['_id']?>">

                        Виберіть категорію:<br>
                        <?php 
                                
                                for ($x=0; $x<=count($categories)-1; $x++) 
                                echo '<input type="radio" name=category required'.(($categories[$x]==$search['category'])?' checked ':" ").'value="'.$categories[$x].'">'.$links[$x+1];
                                echo '<p>';

                                if (isset($search['path']) and $search['path'] !='images/' and file_exists($search['path'])) 
                                        {
                        ?>              
                        
                                         <p>Щоб видалити існуючу картинку натисніть копку нижче:<br>  
                                                Увага! Дія безповоротна
                                        <table class="cell-img" width="348" border="0">
                                                <tr>
                                                        <th width="200">В даній статті є прикріплена картинка</th>
                                                        <th width="30"><a href="index.php?delImg=<?=$search['_id']?>"><img src="images/site/delete.png"></a></th> 
                                                </tr>  
                                         </table>            
                                       
                        <?php 
                                        }    
                        ?> 
                               
                        <p>Виберіть нову картинку для статті:<br>   
                        <input type="file" name="file">
                        <p><input type="submit" value="Зберегти зміни!" formmethod="post"></p>
                </form>
        </div>


        <?php
        }    
        ?>