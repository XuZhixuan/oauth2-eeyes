<?php
namespace sxxuz\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class EeyesResourceOwner implements ResourceOwnerInterface
{
    /**
     * 未处理的用户信息
     *
     * @var $response
     */
    protected $response;

    /**
     * 创建新的用户对象
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
    * 获取用户netID
    *
    * @return string|null
    */
    public function getUsername()
    {
        return $this->response['username'] ?: null;
    }

    /**
    * 获取用户学号
    *
    * @return string|null
    */
    public function getID()
    {
        return $this->response['user_id'] ?: null;
    }

    /**
    * 获取用户姓名
    *
    * @return string|null
    */
    public function getName()
    {
        return $this->response['name'] ?: null;
    }

    /**
    * 获取用户邮箱地址
    *
    * @return string|null
    */
    public function getEmail()
    {
        return $this->response['email'] ?: null;
    }

    /**
    * 获取用户手机号
    *
    * @return string|null
    */
    public function getMobile()
    {
        return $this->response['mobile'] ?: null;
    }

    /**
    * 获取用户学院
    *
    * @return string|null
    */
    public function getDep()
    {
        return $this->response['dep'] ?: null;
    }

    /**
    * 获取用户学院ID
    *
    * @return string|null
    */
    public function getDepID()
    {
        return $this->response['depid'] ?: null;
    }

    /**
    * 获取用户专业
    *
    * @return string|null
    */
    public function getSpeciality()
    {
        return $this->response['speciality'] ?:null;
    }

    /**
    * 获取用户班级
    *
    * @return string|null
    */
    public function getClassID()
    {
        return $this->response['classid'] ?: null;
    }

    /**
    * 获取用户性别
    *
    * @return string|null
    */
    public function getGender()
    {
        return $this->response['gender'] ?: null;
    }

    /**
    * 获取用户生日
    *
    * @return string|null
    */
    public function getBirthday()
    {
        return $this->response['birthday'] ?: null;
    }

    /**
    * 获取用户宿舍号
    *
    * @return string|null
    */
    public function getRoomNumber()
    {
        return $this->response['roomnumber'] ?: null;
    }

    /**
    * 获取用户婚姻状况
    *
    * @return string|null
    */
    public function getMarriage()
    {
        return $this->response['marriage'] ?: null;
    }

    /**
    * 获取用户国籍
    *
    * @return string|null
    */
    public function getNation()
    {
        return $this->response['nation'] ?: null;
    }

    /**
    * 获取用户 Nation Place
    *
    * @return string|null
    */
    public function getNationPlace()
    {
        return $this->response['nationplace'] ?: null;
    }

    /**
    * 获取用户 Polity （考生类型）
    *
    * @return string|null
    */
    public function getPolity()
    {
        return $this->response['polity'] ?: null;
    }

    /**
    * 获取用户类型 （本科生/研究生）
    *
    * @return string|null
    */
    public function getStudentType()
    {
        return $this->response['studenttype'] ?: null;
    }

    /**
    * 获取用户教职工 ID
    *
    * @return string|null
    */
    public function getTutorEmployeeID()
    {
        return $this->response['tutoremployeeid'] ?: null;
    }

    /**
    * 获取用户类型 （学生/教职工）
    *
    * @return string|null
    */
    public function getUserType()
    {
        return $this->response['usertype'] ?: null;
    }

    /**
    * 获取用户家庭电话
    *
    * @return string|null
    */
    public function getRoomPhone()
    {
        return $this->response['roomphone'] ?: null;
    }

    /**
    * 获取用户 ID 卡姓名
    *
    * @return string|null
    */
    public function getIDcardName()
    {
        return $this->response['idcardname'] ?: null;
    }

    /**
    * 获取用户 ID 卡 NO号
    *
    * @return string|null
    */
    public function getIDcardno()
    {
        return $this->response['idcardno'] ?: null;
    }

    /**
     * 将所有用户信息以数组形式返回
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
