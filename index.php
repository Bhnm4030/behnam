<?php
require_once('core.php');
require_once('db.php');


$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chat_id = $update["message"]['chat']['id'];
$user_id = $update["message"]['from']['id']; 
$user_first_name = $update["message"]['from']['first_name']; 
$text = $update["message"]['text'];
$message_id = $update["message"]['message_id'];


$db = Db::getInstance();
$member = $db->query("SELECT * FROM gap WHERE user_id=:user_id", array(
      'user_id' => $user_id,
    ));
 if(count($member)== 1){
     $status = $member[0][status];
     $to_user_id = $member[0][to_user_id];
     $sex = $member[0][sex];
     $con_count = $member[0][con_count];
     $vip = $member[0][vip];

     
    }
else{
        $db = Db::getInstance();
        $db->insert("INSERT INTO gap (user_id) VALUES (:user_id)", array(
        'user_id' => $user_id
         ));
         $sex = 0;
         $status = 0;
         $con_count = 0;
         $vip = 0;
    } 
 


 


      if($text == '/start'){
    
            MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"در خدمتیم .چکار میتونم بکنم واست؟", 'reply_markup' => array(resize_keyboard =>true,
            "keyboard"=>array(
            array('به یه غریبه وصل کن آشنا شیم')
            )
             )));
      }
      else if($sex == 0){
          
          if($text == 'به یه غریبه وصل کن آشناشیم خو'){
              
              MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"دختری یا چسز", 'reply_markup' => array(resize_keyboard =>true,
              "keyboard"=>array(
               array('پسرم 🙋🏻‍♂️','دخترم  🙋🏻')
                )
                 )));

          }
          else if($text == 'دخترم  🙋🏻'){
              // dokhtar = 1
              $db->modify("UPDATE gap SET sex=:sex WHERE user_id=:user_id", array(
              'sex' => 1,
              'user_id' => $user_id
          ));
          MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"خب...حالا بزن زنگو تا وصل کنم لذت ببری", 'reply_markup' => array(resize_keyboard =>true,
            "keyboard"=>array(
            array('زنگو')
            )
             )));
              
          } 
          else if($text == 'پسرم 🙋🏻‍♂️'){
          // pesar = 2
          $db->modify("UPDATE gap SET sex=:sex WHERE user_id=:user_id", array(
              'sex' => 2,
              'user_id' => $user_id
              ));
                        MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"'chat_id' =>$user_id,'text'=>"خب... حالا بزن زنگو تا و صلت کنم
						
", 'reply_markup' => array(resize_keyboard =>true,
                        "keyboard"=>array(
                        array('به یه غریبه وصل کن آشناشیم خو')
                        )
                        )));
              
          }
      }
      else{
          if($text == 'به یه غریبه وصل کن آشناشیم خو& $status != 2){
              if($con_count >= 5 && $vip == 0){
                  $link = "https://moein-khosravi.ir/faranesh/ff/payment.php?user=$user_id";
                  MessageRequestJson("sendMessage", array('chat_id' =>$user_id,disable_web_page_preview =>true,'text'=>
                  exit();
              }
              
              if($status == 1){
                  MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"دندون رو جیگر بزار یه خوبشو پیدا کنم مشتری شی😐"));
                  exit();
              }
              $db = Db::getInstance();
              $waiting_user = $db->query("SELECT * FROM gap WHERE status=:status ORDER BY RAND() LIMIT 1", array(
              'status' => 1,
              ));
               if(count($waiting_user)== 1)
               {
                $waiting_user_id = $waiting_user[0][user_id];
                $waiting_con_count= $waiting_user[0][con_count] + 1;
                $con_count += 1;
                $db->modify("UPDATE gap SET to_user_id=:to_user_id,status=:status,con_count=:con_count WHERE user_id=:user_id", array(
                'to_user_id' => $waiting_user_id,
                'status' => 2,
                'user_id' => $user_id,
                'con_count' => $con_count
                
                ));
                
                $db->modify("UPDATE gap SET to_user_id=:to_user_id,status=:status,con_count=:con_count WHERE user_id=:user_id", array(
                'to_user_id' => $user_id,
                'status' => 2,
                'user_id' => $waiting_user_id,
                'con_count' => $waiting_con_count
                ));
                
                
                
                MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"وصلی. هرچه میخواهد دل تنگت بگووو", 'reply_markup' => array(resize_keyboard =>true,
              "keyboard"=>array(
               array('➡️➡️ قطع کردن مکالمه ⬅️⬅️')
                )
                 )));
                MessageRequestJson("sendMessage", array('chat_id' =>$waiting_user_id,'text'=>"و
               array('➡️➡️ قطع کردن مکالمه ⬅️⬅️')
                )
                 )));
     
               }
               else
               {
                    $db->modify("UPDATE gap SET status=:status WHERE user_id=:user_id", array(
                    'status' => 1,
                    'user_id' => $user_id
                    ));
                    MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"درحال برقراری اتصال.. لطفا صبر کنید😇"));
               }
              

          }
          else if($status == 2 && $text == '➡️➡️ قظعش کنم خال نمیئنب؟
		  ⬅️⬅️' ){
              $db = Db::getInstance();
              $db->modify("UPDATE gap SET to_user_id=:to_user_id,status=:status WHERE user_id=:user_id", array(
                'to_user_id' => 0,
                'status' => 0,
                'user_id' => $user_id
                ));
                
                $db->modify("UPDATE gap SET to_user_id=:to_user_id,status=:status WHERE user_id=:user_id", array(
                'to_user_id' => 0,
                'status' => 0,
                'user_id' => $to_user_id
                ));
              MessageRequestJson("sendMessage", array('chat_id' =>$user_id,'text'=>"مکالمه قطع شد", 'reply_markup' => array(resize_keyboard =>true,
                        "keyboard"=>array(
                        array('به یک ناشناس متصلم کن')
                        )
                        )));
              MessageRequestJson("sendMessage", array('chat_id' =>$to_user_id,'text'=>"مکالمه از طرف شخص مقابل قطع شد", 'reply_markup' => array(resize_keyboard =>true,
                        "keyboard"=>array(
                        array('به یک ناشناس متصلم کن')
                        )
                        )));
          }
          else if($status == 2){
              MessageRequestJson("sendMessage", array('chat_id' =>$to_user_id,'text'=>"$text"));
          }
          
      }
      
      
      
      

      
      

?>