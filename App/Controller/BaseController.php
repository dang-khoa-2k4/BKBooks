<?php


class BaseController{
    const VIEW_FOLDER_NAME = "View";
    const MODEL_FOLDER_NAME = "Model";


    protected function view($viewPath, array $data = [])
    {
        foreach ($data as $key => $value){
            $$key = $value;
        }
        
        $viewPath = self::VIEW_FOLDER_NAME . '/' . str_replace('.' , '/' , $viewPath) . '.php';
        return require_once($viewPath);
    }

    protected function loadModel($model){
        $modelPath = self::MODEL_FOLDER_NAME .'/user'. '/' . $model . '.php';
        return require_once($modelPath);
    }
}
?>