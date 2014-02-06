<?php
/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $username
 * @property string $firstname
 * @property string $secondname
 * @property string $lastname
 * @property string $phone
 * @property string $login_ip
 * @property integer $login_attempts
 * @property integer $login_time
 * @property string $validation_key
 * @property string $password_strategy
 * @property boolean $requires_new_password
 * @property integer $create_id
 * @property integer $create_time
 * @property integer $update_id
 * @property integer $update_time
 * @property integer $delete_id
 * @property integer $delete_time
 * @property string $create_ip
 * @property integer $type
 * @property integer $status
 *
 * @method bool verifyPassword
 *
 * @package YiiBoilerplate\Models
 */
class User extends CActiveRecord
{
    /**
     * @var string attribute used for new passwords on user's edition
     */
    public $newUsername;

	/** @var string Field to hold a new password when user updates it. */
	public $newPassword;

	/** @var string Password confirmation. Is used only in validation on login. */
	public $passwordConfirm;

    /**
     * @var integer attribute used to set anonymous profile or public
     */
    public $profileType;

    /**
     * @var integer attribute used to get max column id and generate username based on it
     */
    public $maxColumn;

    /**
     * @var integer attribute used to determine if user select license agreement checkbox
     */
    public $agree;

	/**
     * Name of the database table associated with this ActiveRecord
     *
	 * @return string
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * Behaviors associated with this ActiveRecord.
     *
     * We are using the APasswordBehavior because it allows neat things
     * like changing the password hashing methods without rebuilding the whole user database.
     *
     * @see https://github.com/phpnode/YiiPassword
     *
	 * @return array Configuration for the behavior classes.
	 */
	public function behaviors()
	{
		Yii::import('common.extensions.behaviors.password.*');
		return [
			// Password behavior strategy
			"APasswordBehavior" => array(
				"class" => "APasswordBehavior",
				"defaultStrategyName" => "bcrypt",
				"strategies" => array(
					"bcrypt" => array(
						"class" => "ABcryptPasswordStrategy",
						"workFactor" => 14,
						"minLength" => 8
					)
				),
			)
		];
	}

	/**
     * Validation rules for model attributes.
     *
     * @see http://www.yiiframework.com/wiki/56/
	 * @return array
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that will receive user inputs.
		return [
            ['email', 'email'],
            ['username, email', 'unique'],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'Username can contain only alphanumeric characters and underscores.'],
            ['email, username, firstname, lastname, password, passwordConfirm', 'required', 'on' => 'create'],
            ['agree', 'required', 'on' => 'create', 'message' => 'You must agree to the Terms and Conditions.'],
            ['email', 'unique', 'on' => 'create', 'message' => Yii::t('user', 'This email has already been taken.')],
            ['passwordConfirm', 'compare', 'compareAttribute' => 'password', 'on' => 'create', 'message' => Yii::t('user', 'Passwords don\'t match')],
			['email, password, salt', 'length', 'max' => 255],
			['requires_new_password, login_attempts', 'numerical', 'integerOnly' => true],
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			['id, username, email', 'safe', 'on' => 'search'],
		];
	}

	/**
     * Customized attribute labels (attr=>label)
     *
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'username' => Yii::t('user', 'Username'),
			'password' => Yii::t('user', 'Password'),
			'newPassword' => Yii::t('user', 'Password'),
			'passwordConfirm' => Yii::t('user', 'Confirm Password'),
			'email' => Yii::t('user', 'E-mail'),
		];
	}

    /**
     * Helper property function
     * @return string the full name of the customer
     */
    public function getFullName()
    {
        return $this->username;
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
        $PARTIAL = true;

		$criteria = new CDbCriteria;
		$criteria->compare('id', $this->id);
		$criteria->compare('username', $this->username, $PARTIAL);
		$criteria->compare('email', $this->email, $PARTIAL);

		return new CActiveDataProvider(get_class($this), compact('criteria'));
	}

	/**
	 * Generates a new validation key (additional security for cookie)
	 */
	public function regenerateValidationKey()
	{
        $validation_key = md5(mt_rand() . mt_rand() . mt_rand());
		$this->saveAttributes(compact('validation_key'));
	}

    /**
	 * Returns the static model of the specified AR class.
     * Mandatory method for ActiveRecord descendants.
     *
     * @param string $className
	 * @return User the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

}
