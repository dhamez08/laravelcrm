<?php

class LayoutSectionSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('LayoutSectionGritSeeder');
        $this->call('LayoutSectionGemiconSeeder');
        $this->call('LayoutSectionSquarepathSeeder');
        $this->call('LayoutSectionNewsletterSeeder');
        $this->call('LayoutSectionSocialMediaSeeder');
        $this->call('LayoutSectionFootersSeeder');
        $this->call('LayoutSectionFocusSeeder');
        $this->call('LayoutSectionContactSheetSeeder');
        $this->call('LayoutSectionImagesTextSeeder');
        $this->call('LayoutSectionTextColumnSeeder');
        $this->call('LayoutSectionImageColumnSeeder');
        $this->call('LayoutSectionLogoHeaderSeeder');
    }

}
