<?php

namespace Models\Companies\RestaurantChains;

use interfaces\FileConvertible;
use Models\Companies\Company;

class RestaurantChain extends Company implements FileConvertible {
    private int $chainId;
    private array $restaurantLocations; // RestaurantLocation[]
    private string $cuisineType;
    private int $numberOfLocations;
    private string $parentCompany;

    public function __construct(
        string $name,
        int $foundingYear,
        string $description,
        string $website,
        string $phone,
        string $industry,
        string $ceo,
        bool $isPubliclyTraded,
        string $country,
        string $founder,
        int $totalEmployees,
        int $chainId,
        array $restaurantLocations,
        string $cuisineType,
        int $numberOfLocations,
        string $parentCompany
    )
    {
        parent::__construct(
            $name,
            $foundingYear,
            $description,
            $website,
            $phone,
            $industry,
            $ceo,
            $isPubliclyTraded,
            $country,
            $founder,
            $totalEmployees,
        );
        $this->chainId = $chainId;
        $this->restaurantLocations = $restaurantLocations;
        $this->cuisineType = $cuisineType;
        $this->numberOfLocations = $numberOfLocations;
        $this->parentCompany = $parentCompany;
    }

    public function getLocationList(string $format): string {
        $locationList = "";
        foreach($this->restaurantLocations as $restaurantLocation) {
            switch($format) {
                case 'html':
                    $locationList .= $restaurantLocation->toHTML();
                    break;
                case 'text':
                    $locationList .= $restaurantLocation->toString() . "\n";
                    break;
                case 'markdown':
                    $locationList .= $restaurantLocation->toMarkdown() . "\n";
                    break;
            }
        }
        return $locationList;
    }

    public function toString(): string {
        return sprintf(
            "
            Chain ID: %d\n
            Restaurant Location: %s\n
            Cuisine Type: %s/n
            Number Of Locations: %d\n
            Parent Company: %s\n
            ",
            $this->chainId,
            $this->getLocationList("text"),
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );
    }

    public function toHTML(): string {
        return sprintf(
            "
            <div class='d-flex justify-content-center p-2 m-2'>
                <h1>Restaurant Chain %s</h1>
            </div>
            %s
            ",
            $this->parentCompany,
            $this->getLocationList("html")
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "
            - Chain Id: %d\n
            - Restaurant Locations: %s\n
            - Cuisine Type: %s\n
            - Number Of Locations: %d\n
            - Parent Company: %s\n
            ",
            $this->chainId,
            $this->getLocationList("markdown"),
            $this->cuisineType,
            $this->numberOfLocations,
            $this->parentCompany
        );
    }

    public function toArray(): array {
        return [
            "chainId" => $this->chainId,
            "restaurantLocations" => $this->restaurantLocations,
            "cuisineType" => $this->cuisineType,
            "numberOfLocations" => $this->numberOfLocations,
            "parentCompany" => $this->parentCompany
        ];
    }

}