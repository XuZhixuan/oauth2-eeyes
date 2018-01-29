<?php
namespace sxxuz\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class EeyesResourceOwner extends ResourceOwnerInterface
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

    public function getUsername()
    {
        return $this->response['username'] ?: null;
    }

    public function getID()
    {
        return $this->response['user_id'] ?: null;
    }

    public function getName()
    {
        return $this->response['name'] ?: null;
    }

    public function getEmail()
    {
        return $this->response['email'] ?: null;
    }

    public function getMobile()
    {
        return $this->response['mobile'] ?: null;
    }

    public function getDep()
    {
        return $this->response['dep'] ?: null;
    }

    public function getDepID()
    {
        return $this->response['depid'] ?: null;
    }

    public function getSpeciality()
    {
        return $this->response['speciality'] ?:null;
    }

    public function getClassID()
    {
        return $this->response['classid'] ?: null;
    }

    public function getGender()
    {
        return $this->response['gender'] ?: null;
    }

    public function getBirthday()
    {
        return $this->response['birthday'] ?: null;
    }

    public function getRoomNumber()
    {
        return $this->response['roomnumber'] ?: null;
    }

    public function getMarriage()
    {
        return $this->response['marriage'] ?: null;
    }

    public function getNation()
    {
        return $this->response['nation'] ?: null;
    }

    public function getNationPlace()
    {
        return $this->response['nationplace'] ?: null;
    }

    public function getPolity()
    {
        return $this->response['polity'] ?: null;
    }

    public function getStudentType()
    {
        return $this->response['studenttype'] ?: null;
    }

    public function getTutorEmployeeID()
    {
        return $this->response['tutoremployeeid'] ?: null;
    }

    public function getUserType()
    {
        return $this->response['usertype'] ?: null;
    }

    public function getRoomPhone()
    {
        return $this->response['roomphone'] ?: null;
    }

    public function getIDcardName()
    {
        return $this->response['idcardname'] ?: null;
    }

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
