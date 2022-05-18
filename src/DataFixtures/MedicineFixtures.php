<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Medicine;
class MedicineFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $items = array(
            array(
                'name' => 'paracetamol',
                'dosage_mg' => 500,
                'price' => 500,
                'expiry_date' => new \DateTime('2023-04-05'),
                'available_quantity' => 10
            ),
            array(
                'name' => 'pentoprazole',
                'dosage_mg' => 500,
                'price' => 500,
                'expiry_date' => new \DateTime('2023-04-05'),
                'available_quantity' => 10
            ),
            array(
                'name' => 'sinex',
                'dosage_mg' => 500,
                'price' => 500,
                'expiry_date' => new \DateTime('2023-04-05'),
                'available_quantity' => 10
            ),
        );
        foreach($items as $item)
        {
            $medicine = new Medicine();
            $medicine
                ->setName($item['name'])
                ->setPrice($item['price'])
                ->setDosageMg($item['dosage_mg'])
                ->setExpiryDate($item['expiry_date'])
                ->setAvailableQuantity($item['available_quantity']);
            $manager->persist($medicine);
        }
        $manager->flush();
    }
}
