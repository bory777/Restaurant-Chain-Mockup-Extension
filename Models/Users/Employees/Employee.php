<?php

namespace Models\Users\Employees;

use DateTime;
use Interfaces\FileConvertible;
use Models\Users\User;

class Employee extends User implements FileConvertible {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $jobTitle;
    private float $salary;
    private DateTime $startDate;
    private array $awards;  // string[]

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phoneNumber,
        string $address,
        DateTime $birthDate,
        DateTime $membershipExpirationDate,
        string $role,
        string $jobTitle,
        float $salary,
        DateTime $startDate,
        array $awards
    )
    {
        parent::__construct(
            $id,
            $firstName,
            $lastName,
            $email,
            $password,
            $phoneNumber,
            $address,
            $birthDate,
            $membershipExpirationDate,
            $role
        );
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->jobTitle = $jobTitle;
        $this->salary = $salary;
        $this->startDate = $startDate;
        $this->awards = $awards;
    }

    public function getAwardsToString(): string {
        return implode(',', $this->awards);
    }

    public function toString(): string {
        return sprintf(
            "
            Job Title: %s\n
            Salary: %s\n
            Start Date: %s\n
            Awards: %s\n
            ",
            $this->jobTitle,
            (string)$this->salary,
            $this->startDate->format('Y-m-d'),
            $this->getAwardsToString()
        );
    }

    public function toHTML(): string {
        return sprintf(
            '
            <tr>
                <th scope="row">%s</th>
                <td>%s</td>
                <td>%s %s</td>
                <td>%s</td>
            </tr>
            ',
            (string)$this->id,
            $this->jobTitle,
            $this->firstName,
            $this->lastName,
            $this->startDate->format('Y-m-d'),
        );
    }

    public function toMarkdown(): string {
        return "- Job Title: {$this->jobTitle}
                - Salary: {$this->salary}
                - Start Date: {$this->startDate->format('Y-m-d')}
                - Awards: {$this->getAwardsToString()}";
    }

    public function toArray(): array {
        return [
            "Job Title" => $this->jobTitle,
            "Salary" => $this->salary,
            "Start Date" => $this->startDate->format('Y-m-d'),
            "Awards" => $this->awards
        ];
    }

    public function getName(): string {
        return $this->firstName . " " . $this->lastName;
    }
}