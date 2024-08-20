<?php

namespace Models\Companies;

use Interfaces\FileConvertible;

class Company implements FileConvertible {
    private string $name;
    private int $foundingYear;
    private string $description;
    private string $website;
    private string $phone;
    private string $industry;
    private string $ceo;
    private bool $isPubliclyTraded;
    private string $country;
    private string $founder;
    private int $totalEmployees;

    public function __construct(string $name, int $foundingYear, string $description, string $website, string $phone, string $industry, string $ceo, bool $isPubliclyTraded, string $country, string $founder, int $totalEmployees) {
        $this->name = $name;
        $this->foundingYear = $foundingYear;
        $this->description = $description;
        $this->website = $website;
        $this->phone = $phone;
        $this->industry = $industry;
        $this->ceo = $ceo;
        $this->isPubliclyTraded = $isPubliclyTraded;
        $this->country = $country;
        $this->founder = $founder;
        $this->totalEmployees = $totalEmployees;
    }

    public function toString(): string {
        return sprintf(
            "会社名：%s\n設立年：%s\n概要：%s\n公式サイト：%s\n電話番号：%s\n業界：%s\nCEO：%s\n上場：%s\n国：%s\n創設者：%s\n従業員数：%s\n",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? "はい" : "いいえ",
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toHTML(): string {
        return sprintf('
            <div class="card">
                <div class="company-header">
                    <h1>会社名：%s</h1>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>設立年：%s</p>
                    <p>概要：%s</p>
                    <p>公式サイト：%s</p>
                    <p>電話番号：%s</p>
                    <p>業界：%s</p>
                    <p>CEO：%s</p>
                    <p>上場：%s</p>
                    <p>国：%s</p>
                    <p>創設者：%s</p>
                    <p>従業員数：%s</p>
                    </blockquote>
                </div>
            </div>
        ',
        $this->name,
        $this->foundingYear,
        $this->description,
        $this->website,
        $this->phone,
        $this->industry,
        $this->ceo,
        $this->isPubliclyTraded ? "はい" : "いいえ",
        $this->country,
        $this->founder,
        $this->totalEmployees
        );
    }

    public function toMarkdown(): string {
        return sprintf(
            "# %s\n\n- **設立年:** %d\n- **概要:** %s\n- **公式サイト:** [%s](%s)\n- **電話番号:** %s\n- **業界:** %s\n- **CEO:** %s\n- **上場:** %s\n- **国:** %s\n- **創設者:** %s\n- **従業員数:** %d\n",
            $this->name,
            $this->foundingYear,
            $this->description,
            $this->website,
            $this->website,
            $this->phone,
            $this->industry,
            $this->ceo,
            $this->isPubliclyTraded ? "はい" : "いいえ",
            $this->country,
            $this->founder,
            $this->totalEmployees
        );
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'foundingYear' => $this->foundingYear,
            'description' => $this->description,
            'website' => $this->website,
            'phone' => $this->phone,
            'industry' => $this->industry,
            'ceo' => $this->ceo,
            'isPubliclyTraded' => $this->isPubliclyTraded ? "はい" : "いいえ",
            'country' => $this->country,
            'founder' => $this->founder,
            'totalEmployees' => $this->totalEmployees,
        ];
    }
}