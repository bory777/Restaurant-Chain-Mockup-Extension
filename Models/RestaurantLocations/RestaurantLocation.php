<?php

namespace Models\RestaurantLocations;

use Interfaces\FileConvertible;

class RestaurantLocation implements FileConvertible {
    private string $name;
    private string $address;
    private string $city;
    private string $state;
    private string $zipCode;
    private array $employees; // Employee[]
    private bool $isOpen;
    private bool $hasDriveThru;

    public function __construct(
        string $name,
        string $address,
        string $city,
        string $state,
        string $zipCode,
        array $employees,
        bool $isOpen,
        bool $hasDriveThru
    )
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->employees = $employees;
        $this->isOpen = $isOpen;
        $this->hasDriveThru = $hasDriveThru;
    }
    
    public function getEmployeeName(): string {
        return implode(', ', array_map(function($employee) {
            return $employee->getName();
        }, $this->employees));
    }

    public function toString(): string {
        return sprintf(
            "
            Name: %s\n
            Address: %s\n
            City: %s\n
            State: %s\n
            Zip Code: %s\n
            Employees: %s\n
            Is Open: %s\n
            Has Drive through: %s\n
            ",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->getEmployeeName(),
            $this->isOpen ? "Yes" : "No",
            $this->hasDriveThru ? "Yes" : "No"
        );
    }

    public function toHTML(): string {
        $employeeList = "";
        foreach($this->employees as $employee){
                $employeeList .= $employee->toHTML();
        }

        return sprintf("
            <div class='accordion mx-4' id='accordionPanelsStayOpenExample'>
                <div class='accordion-item'>
                    <h2 class='accordion-header'>
                        <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#panelsStayOpen-%s' aria-expanded='false' aria-controls='panelsStayOpen-%s'>
                            Restaurant Chain Information
                        </button>
                    </h2>
                    <div id='panelsStayOpen-%s' class='accordion-collapse collapse'>
                        <div class='accordion-body'>
                            <p>会社名：%s, 住所：%s %s %s, 郵便番号：%s</p>
                            <h2>Employees</h2>
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Job</th>
                                        <th scope='col'>Name</th>
                                        <th scope='col'>Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    %s
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            ",
            $this->zipCode,
            $this->zipCode,
            $this->zipCode,
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $employeeList
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "
            ## Name: %s\n
            - Address: %s\n
            - City: %s\n
            - State: %s\n
            - Zip Code: %s\n
            - Employees: %s\n
            - Open: %s\n
            - Drive-Through: %s\n
            ",
            $this->name,
            $this->address,
            $this->city,
            $this->state,
            $this->zipCode,
            $this->getEmployeeName(),
            $this->isOpen ? 'Yes' : 'No',
            $this->hasDriveThru ? 'Yes' : 'No'
        );
    }

    public function toArray(): array {
        return [
            "name" => $this->name,
            "address" => $this->address,
            "city" => $this->city,
            "state" => $this->state,
            "zipCode" => $this->zipCode,
            "employees" => array_map(function($employee) {
                return $employee->getName();
            }, $this->employees),
            "isOpen" => $this->isOpen,
            "hasDriveThru" => $this->hasDriveThru
        ];
    }
}