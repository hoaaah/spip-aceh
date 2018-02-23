<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginResponden extends RespondenKuisionerAwal
{

    // public $nip;
    // public $secret_key;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['nip', 'secret_key'], 'required'],
            // // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateKey()
    {
        // if (!$this->hasErrors()) {
            $responden = $this->getResponden();
            if (!$responden || !(Yii::$app->getSecurity()->validatePassword($this->secret_key, $responden->secret_key)) /*($responden->secret_key !== $this->secret_key)*/ ) {
                $this->addError('nip', 'Incorrect username or password.');
            }else{
                return true;
            }

        // }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validateKey()) {
            return true;
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getResponden()
    {
        $responden = RespondenKuisionerAwal::find()->where(['nip' => $this->nip])->one();
        if($responden) return $responden;

        return false;
    }
}
