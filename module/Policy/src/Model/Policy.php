<?php
namespace Policy\Model;

use Laminas\Filter\StringTrim;
use Laminas\Filter\StripTags;
use Laminas\Filter\ToInt;
use Laminas\InputFilter\InputFilter;
use Laminas\InputFilter\InputFilterAwareInterface;
use Laminas\InputFilter\InputFilterInterface;
use Laminas\Validator\StringLength;

class Policy implements InputFilterAwareInterface
{
    public $id;
    public $fname;
    public $lname;
    public $pno;
    public $startdate;
    public $enddate;
    public $premium;
    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->fname = !empty($data['fname']) ? $data['fname'] : null;
        $this->lname = !empty($data['lname']) ? $data['lname'] : null;
        $this->pno = !empty($data['pno']) ? $data['pno'] : null;
        $this->startdate = !empty($data['startdate']) ? $data['startdate'] : null;
        $this->enddate = !empty($data['enddate']) ? $data['enddate'] : null;
        $this->premium = !empty($data['premium']) ? $data['premium'] : null;

    }
    // Add the following method:
    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'fname' => $this->fname,
            'lname'  => $this->lname,
            'pno'  => $this->pno,
            'startdate'  => $this->startdate,
            'enddate'  => $this->enddate,
            'premium'  => $this->premium,

        ];
    }
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name' => 'id',
            'required' => true,
            'filters' => [
                ['name' => ToInt::class],
            ],
        ]);

        $inputFilter->add([
            'name' => 'artist',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StripTags::class],
                ['name' => StringTrim::class],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;
        return $this->inputFilter;
    }
}
