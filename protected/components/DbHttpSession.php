<?php

class DbHttpSession extends CDbHttpSession
{
    /**
     * Создать таблицу для хранения сессий
     * 
     * @param CDbConnection $db Подключение к БД
     * @param string $tableName Имя таблицы
     * 
     * @return void
     */
    protected function createSessionTable($db, $tableName)
    {
        $db->createCommand()->createTable
        (
            $tableName,
            array
            (
                'id' => 'CHAR(32) PRIMARY KEY',
                'expire' => 'INTEGER',
                'data' => 'TEXT',
                'user_id' => 'INTEGER',
            )
        );
    }
    
    /**
     * Записать данные сессии
     * 
     * @param string $id ID сессии
     * @param string $data Данные сессии
     * 
     * @return boolean Сессия успешно записана
     * 
     * @see http://us.php.net/manual/en/function.session-set-save-handler.php
     */
    public function writeSession($id, $data)
    {
        try
        {
            $expire = time() + $this->getTimeout();
            $db = $this->getDbConnection();
            $table = $this->sessionTableName;
            
            //проверяем данные в сессии
            $exist = false !== $db->createCommand()
                ->select('id')->from($this->sessionTableName)
                ->where('id = :id', array('id' => $id))
                ->queryScalar();
            
            //обновляем
            if ($exist)
            {
                $db->createCommand()->update
                (
                    $this->sessionTableName,
                    array
                    (
                        'data' => $data,
                        'expire' => $expire,
                        'user_id' => Yii::app()->getUser()->getId(),
                    ),
                    'id = :id',
                    array('id' => $id)
                );
            }
            //добавляем
            else
            {
                $db->createCommand()->insert
                (
                    $this->sessionTableName,
                    array
                    (
                        'id' => $id,
                        'data' => $data,
                        'expire' => $expire,
                        'user_id' => Yii::app()->getUser()->getId(),
                    )
                );
            }
        }
        catch (Exception $e)
        {
            Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
            return false;
        }
        
        return true;
    }
} 