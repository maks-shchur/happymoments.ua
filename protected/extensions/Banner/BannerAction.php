<?php

Yii::import("ext.Banner.qqFileUploader3");

class BannerAction extends CAction
{

        public function run()
        {
                // list of valid extensions, ex. array("jpeg", "xml", "bmp")
                $allowedExtensions = array("jpg");
                // max file size in bytes
                $sizeLimit = 1 * 1024 * 1024;

                $uploader = new qqFileUploader3($allowedExtensions, $sizeLimit);
                $result = $uploader->handleUpload('upload/');
                // to pass data through iframe you will need to encode all html tags
                $result=htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                echo $result;
        }
}
