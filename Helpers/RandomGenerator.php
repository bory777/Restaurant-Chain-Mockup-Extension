<?php

namespace Helpers;

use Faker\Factory;
use Models\Companies\RestaurantChains\RestaurantChain;
use Models\RestaurantLocations\RestaurantLocation;
use Models\Users\Employees\Employee;

class RandomGenerator {
    public static function employee(int $minSalary, int $maxSalary): Employee {
        $faker = Factory::create();

        return new Employee(
            $faker->numberBetween(1, 9999),
            $faker->firstName(),
            $faker->lastName(),
            $faker->email,
            $faker->password,
            $faker->phoneNumber,
            $faker->address,
            $faker->dateTimeThisCentury,
            $faker->dateTimeBetween('-10 years', '+20 years'),
            $faker->randomElement(['admin', 'user', 'editor']),
            $faker->jobTitle(),
            $faker->randomFloat(4, $minSalary, $maxSalary),
            $faker->dateTimeBetween('-10 years', 'now'),
            array($faker->randomElement(["Good design","Good taste", "Good Customer service"]))
        );
    }

    public static function employees(int $minSalary, int $maxSalary, int $numberEmployees): array {
        $faker = Factory::create();
        $employees = [];

        for ($i = 0; $i < $numberEmployees; $i++) {
            $employees[] = self::employee($minSalary, $maxSalary);
        }
        return $employees;
    }

    public static function restaurantLocation(
        int $minSalary,
        int $maxSalary,
        int $numberEmployees,
        int $minZipCode,
        int $maxZipCode
        ): RestaurantLocation {

        $faker = Factory::create();

        return new RestaurantLocation(
            $faker->company(),
            $faker->address(),
            $faker->city(),
            $faker->state(),
            $faker->numberBetween($minZipCode, $maxZipCode),
            self::employees($minSalary, $maxSalary, $numberEmployees),
            $faker->boolean(),
            $faker->boolean()
        );
    }

    public static function restaurantLocations(
        int $minSalary,
        int $maxSalary,
        int $numberEmployees,
        int $minZipCode,
        int $maxZipCode,
        int $numberLocations
        ): array {

        $faker = Factory::create();
        $restaurantLocations = [];

        for ($i = 0; $i < $numberLocations; $i++) {
            $restaurantLocations[] = self::restaurantLocation(
                $minSalary,
                $maxSalary,
                $numberEmployees,
                $minZipCode,
                $maxZipCode
            );
        }
        return $restaurantLocations;
    }

    public static function restaurantChain(
        int $minSalary,
        int $maxSalary,
        int $numberEmployees,
        int $minZipCode,
        int $maxZipCode,
        int $numberLocations
    ):RestaurantChain{

        $faker = Factory::create();

        return new RestaurantChain(
            $faker->company(),
            $faker->year(),
            $faker->text(100),
            $faker->url(),
            $faker->phoneNumber(),
            $faker->randomElement(['Restaurant','Hotel','IT','Bank']),
            $faker->name(),
            $faker->boolean(),
            $faker->country(),
            $faker->name(),
            $faker->numberBetween(10, 100),
            $faker->numberBetween(100, 9999),
            self::restaurantLocations($minSalary,$maxSalary,$numberEmployees,$minZipCode,$maxZipCode,$numberLocations),
            $faker->randomElement(['Japanese','French','Chinese','Brazilian','Indian']),
            $numberLocations,
            $faker->company()
        );
    }

    public static function restaurantChains(
        int $minSalary,
        int $maxSalary,
        int $numberEmployees,
        int $minZipCode,
        int $maxZipCode,
        int $numberLocations
    ):array{
        
        $faker = Factory::create();
        $restaurantChains = [];
        $numberOfRestaurantChains = $faker->numberBetween(1, 5);

        for($i = 0;$i < $numberOfRestaurantChains; $i++){
            $restaurantChains[] = self::restaurantChain($minSalary,$maxSalary,$numberEmployees,$minZipCode,$maxZipCode,$numberLocations);
        }
        return $restaurantChains;
    }
}