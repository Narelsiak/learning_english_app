<?php

namespace Modules\Word\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Word\Entities\FillSentence;

class FillSentencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allData = "The human brain is located in the_head_and is responsible for many complex functions such as memory and emotions._latwy_czesci ciala|The muscles that move your arms and legs are called_limbs_and are responsible for the movement of the body._latwy_czesci ciala|The human heart is located in the_chest_and pumps blood throughout the body._latwy_czesci ciala|The body's largest internal organ is the_liver_and is responsible for many important functions such as detoxification and metabolism._latwy_czesci ciala|The part of the ear that transmits sound waves to the inner ear is the_middle ear_and contains the eardrum and three tiny bones._latwy_czesci ciala|The outer layer of skin is called the_epidermis_and protects the body from harmful substances._sredni_czesci ciala|The bones in the human body are connected by_joints_which allow for movement and flexibility._sredni_czesci ciala|The organ responsible for filtering waste products from the blood is the_kidney_and is essential for maintaining proper bodily function._sredni_czesci ciala|The part of the eye that controls the amount of light entering is the_iris_and is responsible for the color of the eyes._sredni_czesci ciala|The part of the digestive system responsible for absorbing nutrients from food is the_small intestine_and is located between the stomach and large intestine._sredni_czesci ciala|The upper part of the respiratory system, where air enters the body, is called the_nasal cavity_and is lined with hairs and mucus to filter out impurities._trudny_czesci ciala|The gland that produces hormones that regulate metabolism and growth is the_thyroid_and is located in the neck._trudny_czesci ciala|The part of the brain responsible for regulating sleep and wakefulness is the_hypothalamus_and is located in the center of the brain._trudny_czesci ciala|The gland responsible for producing insulin, which regulates blood sugar levels, is the_pancreas_and is located in the abdomen._trudny_czesci ciala|The tube connecting the throat to the stomach is called the_esophagus_and is responsible for transporting food._trudny_czesci ciala|he living room is the main_area_of the house where people relax and entertain guests._latwy_dom|The kitchen is where you can prepare_meals_for yourself and your family._latwy_dom|The bedroom is the place where you_sleep_and rest after a long day._latwy_dom|A comfortable sofa is essential for a cozy_living_room._latwy_dom|A clean and tidy home can help reduce_stress_and anxiety._latwy_dom|The bathroom is where you can take a refreshing_shower_or a relaxing bath._sredni_dom|A well-decorated home can make you feel more_comfortable_and happy._sredni_dom|A cozy fireplace is perfect for warming up the_house_on a chilly evening._sredni_dom|The dining room is where you can enjoy a delicious_meal_with your family or guests._sredni_dom|A spacious backyard is great for outdoor_activities_such as gardening or playing with pets._sredni_dom|The attic is a great place for storing_items_that are not used frequently._trudny_dom|Maintaining a clean and organized home requires regular_effort_and dedication._trudny_dom|A leaky roof can cause serious damage to your_property_and should be fixed as soon as possible._trudny_dom|An efficient heating and cooling system can help regulate the_temperature_in your home and save energy._trudny_dom|Building a custom home requires careful planning and_budgeting_to ensure the project is completed successfully._trudny_dom|he stock market is often seen as a barometer of the_economy_because it reflects the overall health of the financial system._latwy_ekonomia|Inflation is the rate at which the general level of_prices_for goods and services is rising, and subsequently purchasing power is falling._latwy_ekonomia|The Gross Domestic Product (GDP) is the total value of all_goods_and services produced by a country in a given year._latwy_ekonomia|The balance of trade refers to the difference between a country's exports and imports, and can have an impact on the country's overall_economy_._latwy_ekonomia|The Consumer Price Index (CPI) is a measure of the average change over time in the prices paid by consumers for a_basket_of goods and services._latwy_ekonomia|When the demand for a product or service is higher than the available supply, the price typically_rises_due to scarcity._sredni_ekonomia|A recession is a period of economic decline, typically identified by a decrease in GDP for two consecutive_quarters_._sredni_ekonomia|The concept of supply and demand is the foundation of a market economy, as the interaction between buyers and sellers ultimately determines the_price_of goods and services._sredni_ekonomia|An oligopoly is a situation where a few large companies dominate a particular_industry_, and have significant influence over the market._sredni_ekonomia|In a capitalist system, the means of production are owned by individuals or private companies, rather than the_state_._sredni_ekonomia|When a company or government spends more money than it brings in through revenue, it incurs a_deficit_._trudny_ekonomia|Fiscal policy refers to the use of government spending and taxation to influence the_economy_, particularly in times of inflation or recession._trudny_ekonomia|A monopoly is a situation where one company or entity controls the entire supply of a particular_product_or service, and has no competition._trudny_ekonomia|Keynesian economics emphasizes the role of government intervention in stabilizing the_economy_during times of recession or depression._trudny_ekonomia|The Federal Reserve is the central banking system of the United States, and is responsible for overseeing monetary policy to promote a stable_economy_._trudny_ekonomia|The CPU is the_brain_of the computer system._latwy_informatyka|A keyboard is an_input_device used to type characters and commands._latwy_informatyka|A Trudny disk drive is a_storage_device that stores and retrieves digital information._latwy_informatyka|The Internet is a global_network_of computers that communicate with each other._latwy_informatyka|Computer viruses are harmful_programs_that can damage or corrupt computer files._latwy_informatyka|Artificial intelligence (AI) refers to the_simulation_of human intelligence in machines._sredni_informatyka|Blockchain is a digital_ledger_of transactions that is decentralized and secure._sredni_informatyka|Machine learning is a type of_AI_that enables machines to learn from data and improve performance on a specific task._sredni_informatyka|Cryptography is the practice of_secure_communication in the presence of third parties._sredni_informatyka|Quantum computing is a technology that uses_quantum_phenomena to perform calculations._sredni_informatyka|The internet of things (IoT) refers to the_network_of physical devices that are connected to the internet and can communicate with each other._trudny_informatyka|Deep learning is a subset of_machine_learning that uses neural networks to analyze and learn from data._trudny_informatyka|Augmented reality (AR) is an_interactive_experience that combines the real world with digital information._trudny_informatyka|Natural language processing (NLP) is a branch of_AI_that enables computers to understand, interpret and generate human language._trudny_informatyka|Cybersecurity refers to the protection of computer systems and networks from_theft_, damage or unauthorized access._trudny_informatyka|Avocado is a_fruit_with a high content of healthy fats._latwy_jedzenie|A smoothie is a_blended_drink made from fruits and veggies._latwy_jedzenie|Nachos are a popular_snack_made from corn chips, cheese, and other toppings._latwy_jedzenie|I always put butter and jam on my_toast_for a quick and Latwy breakfast._latwy_jedzenie|A stir-fry is a popular dish made from_rice_, vegetables, and sometimes meat or seafood._latwy_jedzenie|Fried chicken is a popular dish in many_cuisines_and is often served with sides like mashed potatoes._sredni_jedzenie|Orecchiette is a type of_pasta_that's shaped like a small ear._sredni_jedzenie|Sushi is a popular Japanese dish made with_rice_, raw fish or other seafood, and sometimes vegetables or egg._sredni_jedzenie|Tiramisu is a classic Italian dessert made with_mascarpone_cheese, ladyfingers soaked in coffee, and cocoa powder._sredni_jedzenie|A Caesar salad is a popular salad made with_romaine_lettuce, croutons, Parmesan cheese, and a dressing made from anchovies, garlic, and other ingredients._sredni_jedzenie|Biryani is a popular Indian dish made with_rice_, spices, and sometimes meat, fish, or vegetables._trudny_jedzenie|Coq au vin is a French dish made with_chicken_, bacon, mushrooms, onions, and red wine._trudny_jedzenie|Peking duck is a Chinese dish made with_duck_that's roasted until the skin is crispy and served with thin pancakes, scallions, cucumbers, and hoisin sauce._trudny_jedzenie|Cassoulet is a hearty French stew made with_beans_, pork sausage, duck or goose confit, and sometimes other meats._trudny_jedzenie|Bouillabaisse is a traditional fish stew from the South of_France_made with various fish, shellfish, vegetables, and herbs, served with a side of rouille and bread._trudny_jedzenie|Airplanes have a long_history_of technological advancements._latwy_lotnictwo|The airport_terminal_is where passengers wait for their flights._latwy_lotnictwo|The airplane's_altitude_determines the cabin pressure._latwy_lotnictwo|The flight_attendant_is responsible for passenger safety._latwy_lotnictwo|The airplane's_cockpit_houses the controls and instruments._latwy_lotnictwo|The airplane's_engine_generates the power needed for flight._sredni_lotnictwo|The airplane's_wing_generates lift to keep it in the air._sredni_lotnictwo|Air traffic control_tower_monitors the airspace around an airport._sredni_lotnictwo|The airplane's_fuselage_is the main body of the aircraft._sredni_lotnictwo|The airplane's_navigation_system helps the pilots find their way._sredni_lotnictwo|The airplane's_rudder_is used to control the yaw of the aircraft._trudny_lotnictwo|The airplane's_ailerons_are used to control the roll of the aircraft._trudny_lotnictwo|The airplane's_flaps_are used to increase lift during takeoff and landing._trudny_lotnictwo|The airplane's_spoilers_are used to reduce lift and increase drag._trudny_lotnictwo|The airplane's_thrust_reversers help slow the aircraft down after landing._trudny_lotnictwo|Paris is known as the City of_Light_because of its early adoption of street lighting_latwy_miasto|The famous landmark, the_Empire_State Building, is located in New York City_latwy_miasto|Tokyo is the most populous_city_in Japan_latwy_miasto|The famous_Tower_Bridge is a suspension bridge located in London_latwy_miasto|Tokyo is the capital_city_of Japan_latwy_miasto|The iconic landmark, the_Space_Needle, is located in Seattle_sredni_miasto|The_Colosseum_is a famous amphitheater in Rome, Italy_sredni_miasto|The_Kremlin_is located in Moscow and serves as the official residence of the President of Russia_sredni_miasto|The_Eiffel_Tower is one of the most famous landmarks in Paris, France_sredni_miasto|The_Alhambra_is a palace and fortress complex located in Granada, Spain_sredni_miasto|The_Taj_Mahal is a mausoleum located in Agra, India_trudny_miasto|The_Louvre_Museum is one of the most famous museums in the world, located in Paris_trudny_miasto|The_Forbidden_City is an ancient palace complex in Beijing, China_trudny_miasto|The_Acropolis_is an ancient citadel located on a rocky outcrop above the city of Athens, Greece_trudny_miasto|The_Parthenon_is an ancient temple located on the Acropolis in Athens, Greece_trudny_miasto|To start the car, insert the_key_into the ignition_latwy_motoryzacja|You need to check the_oil_level regularly to keep your engine running smoothly_latwy_motoryzacja|Driving under the influence of alcohol is a serious_offense_and can lead to severe penalties_latwy_motoryzacja|The most effective way to prevent your car from being stolen is to install an_alarm_system_latwy_motoryzacja|If you're looking for a reliable used car, it's a good idea to have a_mechanic_inspect it before you make a purchase_latwy_motoryzacja|One of the best ways to save money on gas is to keep your vehicle's_tires_properly inflated_sredni_motoryzacja|When driving on a slippery road, you should reduce your_speed_to avoid accidents_sredni_motoryzacja|If you hear a strange noise coming from your car, it's important to have it_inspected_by a mechanic_sredni_motoryzacja|When driving on a dirt road, you should reduce your_speed_to avoid damaging the suspension and tires_sredni_motoryzacja|Changing the oil on a hybrid car is similar to changing the oil on a conventional car, but it's important to use the correct_type_of oil_sredni_motoryzacja|The most common cause of a flat tire is a puncture caused by a_nail_or a piece of glass_trudny_motoryzacja|Replacing the clutch on a manual transmission can be a_difficult_and time-consuming job_trudny_motoryzacja|If your car is overheating, the most likely cause is a faulty_radiator_or thermostat_trudny_motoryzacja|When replacing the brake pads, it's important to also check the condition of the_rotors_to ensure proper braking performance_trudny_motoryzacja|To improve the fuel efficiency of your car, you can install a_performance_chip_trudny_motoryzacja|The guitar is a popular_instrument_in rock and roll music._latwy_muzyka|Beethoven was a famous_composer_during the classical era._latwy_muzyka|The rhythm section of a band typically includes a drummer and a_bassist_._latwy_muzyka|The violin and the cello are members of the_string_family._latwy_muzyka|In jazz music, improvisation is an important part of the_performance_._latwy_muzyka|The trumpet, saxophone, and clarinet are all commonly found in a_jazz_band._sredni_muzyka|'''Bohemian Rhapsody'' is a classic song by the British rock band'_Queen_._sredni_muzyka|'The term ''acapella'' refers to singing without any'_instrumental_accompaniment._sredni_muzyka|The band Led Zeppelin was known for their use of_blues_influences in their music._sredni_muzyka|The Beatles were a popular rock band from_Liverpool_, England._sredni_muzyka|Classical music is often performed by a large_orchestra_._trudny_muzyka|The composer Johann Sebastian Bach was born in_Germany_in the 17th century._trudny_muzyka|In opera, a tenor is a type of_male_singer._trudny_muzyka|'The piece ''Rhapsody in Blue'' was composed by George'_Gershwin_and premiered in 1924._trudny_muzyka|'In Indian classical music, a ''raga'' is a musical'_mode_or scale._trudny_muzyka|Bananas are a good source of_potassium_, which is important for proper muscle and nerve function._latwy_owoce i warzywa|Strawberries are a delicious_fruit_that can be enjoyed fresh or used in desserts._latwy_owoce i warzywa|Carrots are a popular_vegetable_that are often eaten raw or cooked._latwy_owoce i warzywa|Apples are a type of_fruit_that comes in many different varieties._latwy_owoce i warzywa|Tomatoes are a versatile_vegetable_that can be used in many different dishes._latwy_owoce i warzywa|Oranges are a citrus_fruit_that is high in vitamin C._sredni_owoce i warzywa|Pineapple is a tropical_fruit_that is sweet and juicy._sredni_owoce i warzywa|Broccoli is a nutritious_vegetable_that is packed with vitamins and minerals._sredni_owoce i warzywa|Avocado is a healthy_fruit_with a high content of healthy fats._sredni_owoce i warzywa|Asparagus is a delicious_vegetable_that can be grilled, steamed, or roasted._sredni_owoce i warzywa|Blueberries are a superfood_fruit_that is rich in antioxidants._trudny_owoce i warzywa|Artichokes are a unique_vegetable_that can be roasted, boiled, or grilled._trudny_owoce i warzywa|Durian is a pungent_fruit_that is considered a delicacy in some cultures._trudny_owoce i warzywa|Brussels sprouts are a nutritious_vegetable_that can be roasted, sautéed, or steamed._trudny_owoce i warzywa|Dragonfruit is a exotic_fruit_with a unique appearance and flavor._trudny_owoce i warzywa|The capital city of Japan is_Tokyo_, which is known for its advanced technology._latwy_panstwa|In South America, the largest country in terms of area is_Brazil_, which is also home to the Amazon rainforest._latwy_panstwa|The national animal of Australia is the_kangaroo_, which is known for its powerful hind legs._latwy_panstwa|The world's largest coral reef system is located off the coast of_Australia_and is called the Great Barrier Reef._latwy_panstwa|The largest country in Europe, in terms of land area, is_Russia_._latwy_panstwa|The Great Wall is located in_China_and is one of the most popular tourist attractions._sredni_panstwa|The Pyramids of Giza, one of the Seven Wonders of the Ancient World, are located in_Egypt_._sredni_panstwa|The largest country in Africa, both by land area and population, is_Nigeria_._sredni_panstwa|The Amazon rainforest spans across several countries, including_Brazil_, Peru, and Colombia._sredni_panstwa|The country known for its fjords, Vikings, and Northern Lights is_Norway_._sredni_panstwa|The Eiffel Tower, one of the most famous landmarks in the world, is located in_France_._trudny_panstwa|The country with the highest population in the world is_China_, with over 1.4 billion people._trudny_panstwa|The highest mountain in the world is_Mount Everest_, which is located in Nepal._trudny_panstwa|The country that is both the smallest by land area and population is_Vatican City_._trudny_panstwa|The country where the famous landmark Angkor Wat is located is_Cambodia_._trudny_panstwa|A passport is a necessary_document_for international travel._latwy_podroze|It's important to pack_light_when traveling._latwy_podroze|I love staying in_hostels_because they are cheap and sociable._latwy_podroze|Negotiating with the local merchants was a_daunting_task._latwy_podroze|The train was so crowded that I had to stand in the_sweltering_heat for hours._latwy_podroze|The flight was delayed_again_due to bad weather conditions._sredni_podroze|The local cuisine is a must-_try_when visiting a new place._sredni_podroze|I always make sure to get travel_insurance_in case of unexpected emergencies._sredni_podroze|Navigating the public transportation system in a foreign country can be_perplexing_._sredni_podroze|Trekking through the dense jungle was a_grueling_experience._sredni_podroze|We got lost in the_labyrinthine_streets of the old city._trudny_podroze|Climbing the_steep_mountain path was a real challenge._trudny_podroze|The ancient ruins are only accessible by a_treacherous_hiking trail._trudny_podroze|The breathtaking scenery was well worth the_arduous_hike._trudny_podroze|I had to overcome my fear of heights to climb the_towering_mountain peak._trudny_podroze|A job interview is an opportunity for a potential employer to learn about a candidate's_qualifications_and determine if they are a good fit for the position._latwy_praca|To be successful at work, it is important to have good_communication_skills to effectively convey ideas and information._latwy_praca|In many jobs, employees are expected to have a certain level of_proficiency_in using computers and technology._latwy_praca|A career in medicine requires years of education and training to gain the necessary_expertise_to treat patients effectively._latwy_praca|Writing a professional resume is an important step in applying for a new_job_and can make a significant difference in the hiring process._latwy_praca|Time management is a crucial skill for anyone who wants to be productive in their_job_and avoid burnout._sredni_praca|A good leader should be able to inspire and motivate their_team_to achieve their goals and work together effectively._sredni_praca|Workplace safety should always be a top_priority_to prevent accidents and injuries on the job._sredni_praca|In some professions, such as law or finance, attention to detail is a crucial_skill_to avoid errors or mistakes that could have serious consequences._sredni_praca|A job interview is also an opportunity for the candidate to learn more about the company's culture and_values_to determine if it is a good fit for them._sredni_praca|Sales representatives are often required to meet specific_targets_in order to meet the company's revenue goals._trudny_praca|In certain industries, employees may need to work night shifts or irregular_hours_to accommodate business needs or customer demands._trudny_praca|The process of developing a new product can involve extensive research and_development_to ensure its success in the market._trudny_praca|Effective teamwork is essential in many workplaces to achieve common_goals_and complete projects efficiently._trudny_praca|Some jobs, such as those in law enforcement or emergency services, require individuals to be able to perform well under_pressure_and make quick decisions in high-stress situations._trudny_praca|A pencil is a common_writing_instrument used for drawing or writing_latwy_przedmioty uzytku codziennego|A smartphone is a handheld_electronic_device used to make phone calls, send text messages, and access the internet_latwy_przedmioty uzytku codziennego|A hammer is a tool used for_hitting_nails into wood or other materials_latwy_przedmioty uzytku codziennego|A drone is an unmanned_aircraft_used for aerial surveillance or delivering goods_latwy_przedmioty uzytku codziennego|A compass is a navigational_instrument_used to indicate direction_latwy_przedmioty uzytku codziennego|A camera is a device used to_capture_images and record videos_sredni_przedmioty uzytku codziennego|A microscope is a device used to_magnify_small objects or organisms for better observation_sredni_przedmioty uzytku codziennego|A keyboard is an input_device_used to type text and commands into a computer_sredni_przedmioty uzytku codziennego|A chainsaw is a portable_power_tool used for cutting wood or trees_sredni_przedmioty uzytku codziennego|A radar is a detection_system_that uses radio waves to determine the distance, angle, or velocity of objects_sredni_przedmioty uzytku codziennego|A telescope is a device used to_observe_distant objects in space_trudny_przedmioty uzytku codziennego|An oscilloscope is a device used to_display_and analyze electronic signals_trudny_przedmioty uzytku codziennego|A spectrophotometer is a device used to_measure_the intensity of light at different wavelengths_trudny_przedmioty uzytku codziennego|A Geiger counter is a device used to_detect_ionizing radiation_trudny_przedmioty uzytku codziennego|A seismometer is a device used to_measure_and record seismic waves_trudny_przedmioty uzytku codziennego|Apples grow on_trees_and are a popular fruit worldwide._latwy_rosliny|Photosynthesis is the process by which plants use_sunlight_to convert carbon dioxide and water into glucose._latwy_rosliny|Many people enjoy having a_garden_where they can grow flowers and vegetables._latwy_rosliny|The_petal_of a flower is often brightly colored to attract pollinators._latwy_rosliny|The_photosynthesis_process is what allows plants to produce their own food._latwy_rosliny|The_stem_of a plant is the part that supports the leaves, flowers, and fruit._sredni_rosliny|The_pollen_from flowers is essential for the reproduction of many plants._sredni_rosliny|Cactus is a type of_plant_that can survive long periods of drought._sredni_rosliny|The roots of the_bamboo_plant grow quickly and can spread over large areas._sredni_rosliny|The leaves of the_eucalyptus_tree are known for their strong and pleasant fragrance._sredni_rosliny|The_chlorophyll_in plant cells gives them their green color and is essential for photosynthesis._trudny_rosliny|The Venus flytrap is a_carnivorous_plant that captures and digests insects for nutrients._trudny_rosliny|The giant redwood tree is one of the tallest_species_of trees in the world, reaching over 300 feet in height._trudny_rosliny|The_stigma_of a flower is the part that receives the pollen during fertilization._trudny_rosliny|The_thorn_on a rose stem is a defense mechanism to protect the plant from herbivores._trudny_rosliny|Basketball is a team_sport_that requires coordination and communication between players._latwy_sport|Swimming is a great way to_exercise_and improve your cardiovascular health._latwy_sport|The most important part of any workout is a proper_warm-up_to prevent injury._latwy_sport|Boxers must have quick reflexes and good_footwork_in order to dodge their opponent's punches._latwy_sport|Skateboarding is a popular extreme_sport_that involves performing tricks and stunts on a board._latwy_sport|In football, the quarterback is responsible for_throwing_the ball to their teammates._sredni_sport|Tennis players need to have good_footwork_in order to quickly move around the court._sredni_sport|Running a marathon requires a lot of_endurance_and mental strength to push through the pain._sredni_sport|Martial arts such as karate and taekwondo require a lot of discipline and_focus_to master._sredni_sport|A triathlon consists of three events: swimming, biking, and_running_, all done in succession._sredni_sport|n soccer, a player who intentionally uses their hands is called for a_handball_and the other team gets a free kick._trudny_sport|Gymnastics requires a lot of_flexibility_and strength to perform complicated maneuvers._trudny_sport|In hockey, players often fight on the ice to defend their_teammate_or send a message to the other team._trudny_sport|In rugby, the ball can only be passed backward, which requires players to have good_spatial awareness_to stay in the game._trudny_sport|In volleyball, a player can't hit the ball twice in a row, so it's important to_communicate_with your teammates to avoid mistakes._trudny_sport|The most important thing for_students_is to focus on their studies in order to achieve good grades._latwy_szkola|The teacher asked the_class_to complete the homework before the next lesson._latwy_szkola|The library is a great_resource_for students who need to study or do research._latwy_szkola|It is essential for_students_to manage their time effectively in order to avoid stress._latwy_szkola|The school has a_cafeteria_where students can buy lunch and snacks during the day._latwy_szkola|The teacher always gives_homework_to the students to reinforce what they learned in class._sredni_szkola|Some students find it_difficult_to concentrate in class because of distractions._sredni_szkola|In order to succeed in_exams_, students need to study Trudny and be well-prepared._sredni_szkola|The school offers various_extracurricular_activities such as sports, music, and drama._sredni_szkola|The teacher gave the_students_a pop quiz to test their knowledge of the previous lesson._sredni_szkola|Group projects are often_challenging_because of the need for collaboration and coordination._trudny_szkola|Students who struggle with_a subject_should consider seeking additional help from a tutor._trudny_szkola|Advanced classes require_students_to have a high level of academic performance and dedication._trudny_szkola|Some students may find the_workload_overwhelming and may need to adjust their study habits._trudny_szkola|The final exam covers all the_material_learned throughout the semester, so students need to review._trudny_szkola|My favorite pair of shoes are my_sneakers_because they're comfortable and stylish._latwy_ubrania|I need to buy a new pair of_pants_because my old ones don't fit me anymore._latwy_ubrania|I love wearing my black leather_jacket_when it's cold outside._latwy_ubrania|She always wears a bright, colorful_scarf_to add some personality to her outfit._latwy_ubrania|I need to get a new pair of_boots_for the winter because my old ones are worn out._latwy_ubrania|He likes to wear a simple white_T-shirt_with jeans on casual days._sredni_ubrania|I can't find my favorite blue_dress_anywhere, I think I might have lost it._sredni_ubrania|The wedding dress was made of the most beautiful_lace_I've ever seen._sredni_ubrania|I always wear my lucky pair of_socks_when I have an important event coming up._sredni_ubrania|I'm not sure which tie to wear with this suit, should I choose the blue or the_red_one?_sredni_ubrania|I'm looking for a pair of running_shorts_that won't ride up when I'm exercising._trudny_ubrania|My friend has a collection of vintage_hats_that she loves to wear to special events._trudny_ubrania|I don't like to wear high-heeled_shoes_because they hurt my feet after a while._trudny_ubrania|I need to find a formal_gown_to wear to the charity ball next month._trudny_ubrania|He always wears a bow_tie_to weddings because he thinks it looks classy._trudny_ubrania|I am feeling_happy_today because the sun is shining._latwy_uczucia|My sister was_thrilled_to hear that she got the job._latwy_uczucia|He was_frustrated_because he couldn't solve the math problem._latwy_uczucia|She felt_relieved_after finishing the difficult exam._latwy_uczucia|They were_proud_of their daughter's performance in the play._latwy_uczucia|I am feeling a bit_anxious_about the upcoming job interview._sredni_uczucia|She was filled with a sense of_contentment_after spending the day with her family._sredni_uczucia|He was overcome with_grief_after the death of his beloved pet._sredni_uczucia|I felt a rush of_excitement_when I received the acceptance letter._sredni_uczucia|She was feeling a sense of_nostalgia_when she visited her hometown after years._sredni_uczucia|He was struggling with a feeling of_loneliness_after moving to a new city._trudny_uczucia|She was consumed with_envy_when she saw her friend's new car._trudny_uczucia|He was experiencing a sense of_hopelessness_after losing his job._trudny_uczucia|She was tormented by a feeling of_guilt_after lying to her friend._trudny_uczucia|He was battling with a feeling of_despair_after the breakup of his relationship._trudny_uczucia|A dentist is a medical_professional_who specializes in teeth and gum health._latwy_zawody|The main duty of a firefighter is to_extinguish_fires and rescue people from dangerous situations._latwy_zawody|A pilot is responsible for operating an aircraft and ensuring the safety of_passengers_on board._latwy_zawody|A teacher is someone who_educates_students and helps them learn new things._latwy_zawody|A chef is a professional_cook_who prepares and creates dishes for restaurants and other food establishments._latwy_zawody|An architect is a professional who designs and plans_buildings_for construction._sredni_zawody|A lawyer is a person who practices_law_and represents clients in legal matters._sredni_zawody|An engineer is someone who designs and creates_machines_or structures to solve problems._sredni_zawody|A journalist is someone who reports on_news_and events for a media outlet._sredni_zawody|A scientist is someone who conducts_research_in a specific field of study to discover new knowledge._sredni_zawody|A surgeon is a medical professional who performs_operations_on patients to treat injuries or illnesses._trudny_zawody|An astronaut is someone who travels into_space_to conduct research or explore new frontiers._trudny_zawody|A CEO is the highest-ranking_executive_in a company who makes major corporate decisions._trudny_zawody|A professional athlete is someone who competes in sports at a_high_level and earns a living doing so._trudny_zawody|An economist is someone who studies the production and distribution of_goods_and services in an economy._trudny_zawody|The lion is considered the king of the_jungle_due to its strength and power._latwy_zwierzeta|Dogs are known for their_loyalty_and are often referred to as 'man's best friend.'_latwy_zwierzeta|The tiger is a large_feline_species known for its distinctive stripes._latwy_zwierzeta|The elephant is the largest_land_animal on Earth._latwy_zwierzeta|The koala is a small, cuddly_marsupial_native to Australia._latwy_zwierzeta|The octopus is a highly intelligent_sea_creature with eight arms._sredni_zwierzeta|The chameleon is a unique_reptile_that can change its color to blend in with its surroundings._sredni_zwierzeta|The penguin is a flightless_bird_that is well adapted to living in cold climates._sredni_zwierzeta|The cheetah is the fastest_land_animal in the world, capable of reaching speeds of up to 70 mph._sredni_zwierzeta|The orangutan is a great ape native to_Asia_and is known for its distinctive orange fur._sredni_zwierzeta|The crocodile is a large_reptile_with a powerful bite and tough, scaly skin._trudny_zwierzeta|The grizzly bear is a large_mammal_found in North America and known for its aggressive behavior._trudny_zwierzeta|The blue whale is the largest_marine_animal on Earth and can grow up to 100 feet in length._trudny_zwierzeta|The black mamba is a highly venomous_snake_found in Africa and known for its deadly bite._trudny_zwierzeta|The komodo dragon is a large, carnivorous_lizard_native to Indonesia and known for its deadly bite._trudny_zwierzeta";

        $allData = explode("|", $allData);
        foreach ($allData as &$item) {
            $item = explode("_", $item);
            FillSentence::create([
                'sentence' => [
                    '1' => $item[0],
                    '2' => '',
                    '3' => $item[2],
                ],
                'correct_answer' => $item[1],
            ]);
        }


    
        
    }
}