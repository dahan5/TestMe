<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classArray = [
            'Front-Angular', 'Front-PHP', 'Front-React', 'Front-Vue',
            'Mob-Flutter', 'Mob-RN', 'Mob-Android', 'Mob-iOS',
            'Spring-Boot', 'Spring-Cloud', 'Java-17', 'Python', 'R', 'PHP-8',
            'C#', 'C++', 'Rust', '.Net', '.Net-Core', 'NodeJS',
            'Apache-Tomcat', 'Apache-Kafka', 'Apache-Spark', 'Apache-Lucene-Solr',
            'Apache-CouchDB', 'Apache-Maven',
            'MySQL', 'SQL-Server', 'Oracle', 'MongoDB', 'SAP-Hana',
            'DevOps', 'AWS', 'GCP', 'BigData', 'Hadoop', 'Tableau', 'Qlik',
            'Data-Science', 'Cloud-Computing',
            'Git', 'Gradle', 'Linux-OS',
            'Cryptography', 'QA-Hacking', 'QA-Testing',
            'Project-Manager', 'Product-Owner', 'Scrum-Master', 'Marketing', 'HR'
        ];

        foreach ($classArray as $order => $clazz) {
            DB::table('classes')->insert([
                'id' => Uuid::uuid4(),
                'display_order' => $order + 1,
                'class' => $clazz
            ]);
        }
    }
}
