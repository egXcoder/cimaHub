<?php

use Illuminate\Database\Seeder;

class ActorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actors')->delete();
        
        \DB::table('actors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Eric Roberts',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/sZ6MiyrU6VWFavcArxOBhTMIyYq.jpg',
                'created_at' => '2019-06-24 14:22:32',
                'updated_at' => '2019-06-24 14:22:32',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ice-T',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/2XsNifyKI37XBbBbZEH8P21god1.jpg',
                'created_at' => '2019-06-24 14:22:33',
                'updated_at' => '2019-06-24 14:22:33',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Sarah Pribis',
                'image_url' => 'https://pbs.twimg.com/profile_images/968861021044641792/wO-9tAiE_400x400.jpg',
                'created_at' => '2019-06-24 14:22:34',
                'updated_at' => '2019-06-24 14:22:34',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Vincent Pastore',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/4SlzY9TtgQKDVu2GIYu3M73MxeP.jpg',
                'created_at' => '2019-06-24 14:22:35',
                'updated_at' => '2019-06-24 14:22:35',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Samuel L. Jackson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/mXN4Gw9tZJVKrLJHde2IcUHmV3P.jpg',
                'created_at' => '2019-06-24 14:22:37',
                'updated_at' => '2019-06-24 14:22:37',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Vanessa Williams',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/gZv46vwlyWK6Nx13uXmndg1Qkhu.jpg',
                'created_at' => '2019-06-24 14:22:38',
                'updated_at' => '2019-06-24 14:22:38',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Jeffrey Wright',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/3vTuujdbZahJ11KGUMHei6HDdOo.jpg',
                'created_at' => '2019-06-24 14:22:39',
                'updated_at' => '2019-06-24 14:22:39',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Christian Bale',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/pPXnqoGD91znz4FwQ6aKuxi6Pcy.jpg',
                'created_at' => '2019-06-24 14:22:41',
                'updated_at' => '2019-06-24 14:22:41',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Judi Dench',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/2is9RvJ3BQAku2EtCmyk5EZoxzT.jpg',
                'created_at' => '2019-06-24 14:22:44',
                'updated_at' => '2019-06-24 14:22:44',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Sophie Cookson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/5uD97ej1SS9P4Pq1LmI0wnLckss.jpg',
                'created_at' => '2019-06-24 14:22:45',
                'updated_at' => '2019-06-24 14:22:45',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Stephen Campbell Moore',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/9LPG6fCe2ct82Io5zI8iyvJ8NsP.jpg',
                'created_at' => '2019-06-24 14:22:46',
                'updated_at' => '2019-06-24 14:22:46',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Tom Hughes',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/ct7dnN3uC326B8u3wUM8zDzFBsK.jpg',
                'created_at' => '2019-06-24 14:22:47',
                'updated_at' => '2019-06-24 14:22:47',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Gugu Mbatha-Raw',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/zDivqZnCWcZuC0LOLxd9Fxuv2zM.jpg',
                'created_at' => '2019-06-24 14:22:49',
                'updated_at' => '2019-06-24 14:22:49',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'David Strathairn',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/5P9hWKVBXVD6bNdDO3O7upa1A6S.jpg',
                'created_at' => '2019-06-24 14:22:50',
                'updated_at' => '2019-06-24 14:22:50',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Lorraine Toussaint',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/tHvHTU5gV68sNig0kUBatXWuwt9.jpg',
                'created_at' => '2019-06-24 14:22:51',
                'updated_at' => '2019-06-24 14:22:51',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Christopher Denham',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/oPnHnLW51n9qFtCxh4phejRm6xe.jpg',
                'created_at' => '2019-06-24 14:22:52',
                'updated_at' => '2019-06-24 14:22:52',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Amber Benson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/hcatQaJNb2lAcBukfn6IOaxtl5F.jpg',
                'created_at' => '2019-06-24 14:22:54',
                'updated_at' => '2019-06-24 14:22:54',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Kevin Chamberlin',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/wRbmptQghO6Dy2E1a93GepGEbcZ.jpg',
                'created_at' => '2019-06-24 14:22:55',
                'updated_at' => '2019-06-24 14:22:55',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Mat Devine',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Mat_Devine.jpg/220px-Mat_Devine.jpg',
                'created_at' => '2019-06-24 14:22:56',
                'updated_at' => '2019-06-24 14:22:56',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Mieko Hillman',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/hrD6lOYzcTeCd8RFCSOP7jSkQPE.jpg',
                'created_at' => '2019-06-24 14:22:57',
                'updated_at' => '2019-06-24 14:22:57',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Taraji P. Henson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/rxnEvzGlRBsE94s7lC4cMAiLluH.jpg',
                'created_at' => '2019-06-24 14:22:59',
                'updated_at' => '2019-06-24 14:22:59',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Sam Rockwell',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/vYpWxV0bnUgKo7SdasfGP9HttUq.jpg',
                'created_at' => '2019-06-24 14:23:00',
                'updated_at' => '2019-06-24 14:23:00',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Babou Ceesay',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/7HtIvbNxACa03ofJpN4EFQTNtRU.jpg',
                'created_at' => '2019-06-24 14:23:01',
                'updated_at' => '2019-06-24 14:23:01',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Nick Searcy',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/dAmLsoZCYSHABdCxbc64oMVaAkd.jpg',
                'created_at' => '2019-06-24 14:23:02',
                'updated_at' => '2019-06-24 14:23:02',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Cary Elwes',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/wmvYoJHStQeQzrpqOM9tkvf1wwF.jpg',
                'created_at' => '2019-06-24 14:23:05',
                'updated_at' => '2019-06-24 14:23:05',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Shannyn Sossamon',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/nJUFCRm7Y0YVR3GQ8GSZUzDavH1.jpg',
                'created_at' => '2019-06-24 14:23:06',
                'updated_at' => '2019-06-24 14:23:06',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Danielle Campbell',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/h3kLxMJT1SL8zfTtQPTd7mYRm8S.jpg',
                'created_at' => '2019-06-24 14:23:07',
                'updated_at' => '2019-06-24 14:23:07',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Carol Kane',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/4ZPnxUFgUHND5fv6MshT3YRDLmq.jpg',
                'created_at' => '2019-06-24 14:23:08',
                'updated_at' => '2019-06-24 14:23:08',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'William Shatner',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/4byp8PsbRkC3UQVuvMAh4bcj7E2.jpg',
                'created_at' => '2019-06-24 14:23:10',
                'updated_at' => '2019-06-24 14:23:10',
            ),
            29 => 
            array (
                'id' => 32,
                'name' => 'Robert Emhardt',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/fYMw0dolhykl8z34sGKqS2OGAjC.jpg',
                'created_at' => '2019-06-24 14:23:14',
                'updated_at' => '2019-06-24 14:23:14',
            ),
            30 => 
            array (
                'id' => 34,
                'name' => 'Anthony Backman',
                'image_url' => 'https://m.media-amazon.com/images/M/MV5BMTgzMzg5NDAxN15BMl5BanBnXkFtZTYwODI4MTAz._V1_UX214_CR0,0,214,317_AL_.jpg',
                'created_at' => '2019-06-24 14:23:17',
                'updated_at' => '2019-06-24 14:23:17',
            ),
            31 => 
            array (
                'id' => 35,
                'name' => 'Elena Chernyakova',
                'image_url' => 'https://static.businessinsider.com/image/5213ea5569bedd300b000027-750.jpg',
                'created_at' => '2019-06-24 14:23:18',
                'updated_at' => '2019-06-24 14:23:18',
            ),
            32 => 
            array (
                'id' => 36,
                'name' => 'Renee Madison Cole',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/n2nzpCRAR1rW7GnPtyrQ7qNfWCr.jpg',
                'created_at' => '2019-06-24 14:23:19',
                'updated_at' => '2019-06-24 14:23:19',
            ),
            33 => 
            array (
                'id' => 37,
                'name' => 'Kelli Giddish',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/p9HZBmkCUm1HeSp9U5xSvhDxZjp.jpg',
                'created_at' => '2019-06-24 14:23:22',
                'updated_at' => '2019-06-24 14:23:22',
            ),
            34 => 
            array (
                'id' => 38,
                'name' => 'Cole Hauser',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/2izzcOrZpt22ObHjSNq3qRhrGHu.jpg',
                'created_at' => '2019-06-24 14:23:23',
                'updated_at' => '2019-06-24 14:23:23',
            ),
            35 => 
            array (
                'id' => 39,
                'name' => 'Jesse Metcalfe',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/t94xhTY2tdMhYR3CO1wMDwx9OpX.jpg',
                'created_at' => '2019-06-24 14:23:24',
                'updated_at' => '2019-06-24 14:23:24',
            ),
            36 => 
            array (
                'id' => 40,
                'name' => 'Amaury Nolasco',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/tFH2iQmCIARuPJwjqcw7STwLeEr.jpg',
                'created_at' => '2019-06-24 14:23:25',
                'updated_at' => '2019-06-24 14:23:25',
            ),
            37 => 
            array (
                'id' => 41,
                'name' => 'Alban Lenoir',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/xJ30y5a0ZdWpujwcGkl5dLy5NC7.jpg',
                'created_at' => '2019-06-24 14:23:27',
                'updated_at' => '2019-06-24 14:23:27',
            ),
            38 => 
            array (
                'id' => 42,
                'name' => 'Olga Kurylenko',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/zkOOwEzs0VhbK7t4PhqEZALEWeE.jpg',
                'created_at' => '2019-06-24 14:23:28',
                'updated_at' => '2019-06-24 14:23:28',
            ),
            39 => 
            array (
                'id' => 43,
                'name' => 'Sébastien Lalanne',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/28oNL7uSHSJiaDnHWqnx56E1cvW.jpg',
                'created_at' => '2019-06-24 14:23:29',
                'updated_at' => '2019-06-24 14:23:29',
            ),
            40 => 
            array (
                'id' => 44,
                'name' => 'David Murgia',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/ikSoZd35cHLQJYh9kIBbagQphSK.jpg',
                'created_at' => '2019-06-24 14:23:31',
                'updated_at' => '2019-06-24 14:23:31',
            ),
            41 => 
            array (
                'id' => 45,
                'name' => 'Patrick Cavanaugh',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/B5kuj6jXzEXbteymVqgHD57xGz.jpg',
                'created_at' => '2019-06-24 14:23:32',
                'updated_at' => '2019-06-24 14:23:32',
            ),
            42 => 
            array (
                'id' => 46,
                'name' => 'Adam William Ward',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/mNRvfFiPLQB05J8ta5H9KFN8BTD.jpg',
                'created_at' => '2019-06-24 14:23:34',
                'updated_at' => '2019-06-24 14:23:34',
            ),
            43 => 
            array (
                'id' => 47,
                'name' => 'Aaron Groben',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/sJK6i0eIll6ZsU96f1x6ZRoIffg.jpg',
                'created_at' => '2019-06-24 14:23:35',
                'updated_at' => '2019-06-24 14:23:35',
            ),
            44 => 
            array (
                'id' => 48,
                'name' => 'James Babson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/PsYYzL0CcFhCGyq2rpQq8uHF8n.jpg',
                'created_at' => '2019-06-24 14:23:36',
                'updated_at' => '2019-06-24 14:23:36',
            ),
            45 => 
            array (
                'id' => 49,
                'name' => 'Kate Davies-Speak',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/xQlT8q8XZEOSDrVQMm0oCYmHbhU.jpg',
                'created_at' => '2019-06-24 14:23:38',
                'updated_at' => '2019-06-24 14:23:38',
            ),
            46 => 
            array (
                'id' => 51,
                'name' => 'Peter Cosgrove',
                'image_url' => 'https://s3-eu-west-1.amazonaws.com/images.castcall.blue-compass.com/portfolioraw/648/648816.jpg',
                'created_at' => '2019-06-24 14:23:40',
                'updated_at' => '2019-06-24 14:23:40',
            ),
            47 => 
            array (
                'id' => 52,
                'name' => 'Rowena Bentley',
                'image_url' => 'https://pbs.twimg.com/media/Dqxc6s8X4AAjwZH.jpg',
                'created_at' => '2019-06-24 14:23:40',
                'updated_at' => '2019-06-24 14:23:40',
            ),
            48 => 
            array (
                'id' => 53,
                'name' => 'Angel Bonanni',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/3YJrxH2yeIwSQJb4bwKVZbSBjDs.jpg',
                'created_at' => '2019-06-24 14:23:43',
                'updated_at' => '2019-06-24 14:23:43',
            ),
            49 => 
            array (
                'id' => 55,
                'name' => 'Mickey Leon',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/qRgOpwEOOi2lU0oahL1J5sOYvQM.jpg',
                'created_at' => '2019-06-24 14:23:45',
                'updated_at' => '2019-06-24 14:23:45',
            ),
            50 => 
            array (
                'id' => 56,
                'name' => 'Sergey Bukhman',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/itcMD5QocKmMj9gnS1dkA9GiVZB.jpg',
                'created_at' => '2019-06-24 14:23:46',
                'updated_at' => '2019-06-24 14:23:46',
            ),
            51 => 
            array (
                'id' => 57,
                'name' => 'Sylvester Stallone',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/gnmwOa46C2TP35N7ARSzboTdx2u.jpg',
                'created_at' => '2019-06-24 14:23:49',
                'updated_at' => '2019-06-24 14:23:49',
            ),
            52 => 
            array (
                'id' => 58,
                'name' => 'Dave Bautista',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/mR7ZdtykA2MvT6ZCZtM4pjXW1gA.jpg',
                'created_at' => '2019-06-24 14:23:50',
                'updated_at' => '2019-06-24 14:23:50',
            ),
            53 => 
            array (
                'id' => 59,
                'name' => '50 Cent',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/gsEwsWWtC5xwFCzL2CnPmc24uIO.jpg',
                'created_at' => '2019-06-24 14:23:51',
                'updated_at' => '2019-06-24 14:23:51',
            ),
            54 => 
            array (
                'id' => 60,
                'name' => 'Jaime King',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/zxRIrvJly1KIZdLA8c3B024LezU.jpg',
                'created_at' => '2019-06-24 14:23:52',
                'updated_at' => '2019-06-24 14:23:52',
            ),
            55 => 
            array (
                'id' => 61,
                'name' => 'Harry Hamlin',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/1UKokwUL9S9VoXIx3u0AcQBhDoN.jpg',
                'created_at' => '2019-06-24 14:23:54',
                'updated_at' => '2019-06-24 14:23:54',
            ),
            56 => 
            array (
                'id' => 62,
                'name' => 'Susan Dey',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/q30y7D1pVP2gdIvzscV0Tw7jGCf.jpg',
                'created_at' => '2019-06-24 14:23:55',
                'updated_at' => '2019-06-24 14:23:55',
            ),
            57 => 
            array (
                'id' => 65,
                'name' => 'Jung-min Hwang',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/2T81Q4tgjsrPnmbarHnQwySNPZd.jpg',
                'created_at' => '2019-06-24 14:24:02',
                'updated_at' => '2019-06-24 14:24:02',
            ),
            58 => 
            array (
                'id' => 66,
                'name' => 'Ji-hyun Jun',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/nVyQzEVHv558DAjYmfrAOCQpyXA.jpg',
                'created_at' => '2019-06-24 14:24:03',
                'updated_at' => '2019-06-24 14:24:03',
            ),
            59 => 
            array (
                'id' => 69,
                'name' => 'Vera Farmiga',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/5pcldEtSzmINHujFGipjAURg2CV.jpg',
                'created_at' => '2019-06-24 14:24:06',
                'updated_at' => '2019-06-24 14:24:06',
            ),
            60 => 
            array (
                'id' => 70,
                'name' => 'Jacob Tremblay',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/7ePQeYnYbTSOAVxPNEN166Rr3GI.jpg',
                'created_at' => '2019-06-24 14:24:07',
                'updated_at' => '2019-06-24 14:24:07',
            ),
            61 => 
            array (
                'id' => 71,
                'name' => 'Virginia Madsen',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/5lMrn7kspxiZziWM4lEw1V6S9Bz.jpg',
                'created_at' => '2019-06-24 14:24:08',
                'updated_at' => '2019-06-24 14:24:08',
            ),
            62 => 
            array (
                'id' => 72,
                'name' => 'Marton Csokas',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/g36Ydyv0YbwXLOQ2KzGjFfkCDo1.jpg',
                'created_at' => '2019-06-24 14:24:09',
                'updated_at' => '2019-06-24 14:24:09',
            ),
            63 => 
            array (
                'id' => 76,
                'name' => 'Michael Dickens',
                'image_url' => 'https://snusercontent.global.ssl.fastly.net/member-headshot-square-large/53/4238553_10787540.jpg',
                'created_at' => '2019-06-24 14:24:14',
                'updated_at' => '2019-06-24 14:24:14',
            ),
            64 => 
            array (
                'id' => 77,
                'name' => 'Blanchard Ryan',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/96iDgfr3ub8doHljZYpsAzawDw7.jpg',
                'created_at' => '2019-06-24 14:24:17',
                'updated_at' => '2019-06-24 14:24:17',
            ),
            65 => 
            array (
                'id' => 78,
                'name' => 'Daniel Travis',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/lvgCjRKCdT0vxIyQLjwRkwqLVio.jpg',
                'created_at' => '2019-06-24 14:24:18',
                'updated_at' => '2019-06-24 14:24:18',
            ),
            66 => 
            array (
                'id' => 79,
                'name' => 'Saul Stein',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/8OcSrkpuyqWbl5wldBoSLDBbMrK.jpg',
                'created_at' => '2019-06-24 14:24:19',
                'updated_at' => '2019-06-24 14:24:19',
            ),
            67 => 
            array (
                'id' => 81,
                'name' => 'Aleksandra Cwen',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/buEyYEG6N6NqY6RcOF0nURuTbwY.jpg',
                'created_at' => '2019-06-24 14:24:22',
                'updated_at' => '2019-06-24 14:24:22',
            ),
            68 => 
            array (
                'id' => 82,
                'name' => 'Celina Peter',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/zeZmqiheRlMwuedG2pedVQktrky.jpg',
                'created_at' => '2019-06-24 14:24:23',
                'updated_at' => '2019-06-24 14:24:23',
            ),
            69 => 
            array (
                'id' => 83,
                'name' => 'Claudia Martini',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/4qMAfjykvPdk6jwi25P68jnM82m.jpg',
                'created_at' => '2019-06-24 14:24:24',
                'updated_at' => '2019-06-24 14:24:24',
            ),
            70 => 
            array (
                'id' => 84,
                'name' => 'Tanja Petrovsky',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/e4VQyGaZCTgC5bvyw6ebl3KLHff.jpg',
                'created_at' => '2019-06-24 14:24:25',
                'updated_at' => '2019-06-24 14:24:25',
            ),
            71 => 
            array (
                'id' => 85,
                'name' => 'Chris Hemsworth',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/lrhth7yK9p3vy6p7AabDUM1THKl.jpg',
                'created_at' => '2019-06-24 14:24:27',
                'updated_at' => '2019-06-24 14:24:27',
            ),
            72 => 
            array (
                'id' => 86,
                'name' => 'Tessa Thompson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/3POwFJPt9Mn7UqktzgoRQKjnfwp.jpg',
                'created_at' => '2019-06-24 14:24:28',
                'updated_at' => '2019-06-24 14:24:28',
            ),
            73 => 
            array (
                'id' => 87,
                'name' => 'Kumail Nanjiani',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/9EyrK1Cv7ey1h1GgmsVAOn45w6G.jpg',
                'created_at' => '2019-06-24 14:24:29',
                'updated_at' => '2019-06-24 14:24:29',
            ),
            74 => 
            array (
                'id' => 88,
                'name' => 'Rebecca Ferguson',
                'image_url' => 'https://image.tmdb.org/t/p/w180_and_h180_face/dbIS4S32rrIJyEysx7huT6ZAmjN.jpg',
                'created_at' => '2019-06-24 14:24:30',
                'updated_at' => '2019-06-24 14:24:30',
            ),
        ));
        
        
    }
}