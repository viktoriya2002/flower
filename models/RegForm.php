<?php

namespace app\models;

class RegForm extends User
{
    public $confirm_password;
    public $agree;
    public function rules()
    {
        return [
            [['name', 'surname', 'login','email', 'password'], 'required'],
            [['admin'], 'integer'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern'=>'/^[А-ЯЁа-яё]{3,}/u', 'message'=>'Используйте минимум 5 русских букв'],
            [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9]{3,}/', 'message'=>'Используйте минимум 5 латинских букв и цифр'],
            [['email'], 'email'],
            [['confirm_password'], 'compare', 'compareAttribute'=>'password'],
            [['email'], 'unique'],
            [['agree'], 'compare', 'compareValue'=>true, 'message'=>''],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
            ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'admin' => 'Admin',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных данных',
 ];
 }
}
