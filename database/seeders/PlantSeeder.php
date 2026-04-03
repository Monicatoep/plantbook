<?php

namespace Database\Seeders;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Seeder;

class PlantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plants = [
            ['name' => 'Monstera Deliciosa', 'description' => 'A tropical plant known for its large, fenestrated leaves. Native to Central American rainforests.'],
            ['name' => 'Fiddle Leaf Fig', 'description' => 'A popular indoor tree with large, violin-shaped leaves that thrives in bright indirect light.'],
            ['name' => 'Snake Plant', 'description' => 'An almost indestructible plant with stiff, upright leaves. Excellent air purifier that tolerates low light.'],
            ['name' => 'Pothos', 'description' => 'A trailing vine with heart-shaped leaves. One of the easiest houseplants to grow.'],
            ['name' => 'Peace Lily', 'description' => 'An elegant plant with dark green leaves and white spathes. Thrives in low to medium light.'],
            ['name' => 'Spider Plant', 'description' => 'A resilient plant that produces baby plantlets on long arching stems. Great for hanging baskets.'],
            ['name' => 'Rubber Plant', 'description' => 'A bold houseplant with thick, glossy burgundy leaves. Grows into a small indoor tree.'],
            ['name' => 'Aloe Vera', 'description' => 'A succulent with thick, fleshy leaves containing a soothing gel. Loves bright, direct sunlight.'],
            ['name' => 'Boston Fern', 'description' => 'A classic fern with arching, feathery fronds. Prefers humid environments and indirect light.'],
            ['name' => 'ZZ Plant', 'description' => 'A drought-tolerant plant with waxy, dark green leaves. Thrives on neglect and low light.'],
            ['name' => 'Philodendron', 'description' => 'A versatile tropical plant with heart-shaped leaves. Fast-growing and easy to propagate.'],
            ['name' => 'Calathea Orbifolia', 'description' => 'A stunning prayer plant with large, round leaves striped in silver and green.'],
            ['name' => 'String of Pearls', 'description' => 'A trailing succulent with small, bead-like leaves. Perfect for hanging planters.'],
            ['name' => 'Bird of Paradise', 'description' => 'A dramatic tropical plant with large banana-like leaves. Can produce exotic orange flowers.'],
            ['name' => 'Chinese Money Plant', 'description' => 'A trendy plant with round, coin-shaped leaves on long petioles. Easy to share via offsets.'],
            ['name' => 'Jade Plant', 'description' => 'A slow-growing succulent with thick, oval leaves. Symbolizes good luck and prosperity.'],
            ['name' => 'English Ivy', 'description' => 'A classic trailing vine with lobed leaves. Excellent for hanging baskets and topiaries.'],
            ['name' => 'Dracaena Marginata', 'description' => 'A tree-like plant with thin red-edged leaves. Tolerates a wide range of indoor conditions.'],
            ['name' => 'Cast Iron Plant', 'description' => 'An extremely hardy plant with dark green, lance-shaped leaves. Survives in very low light.'],
            ['name' => 'Parlor Palm', 'description' => 'A compact palm with elegant, arching fronds. One of the most popular indoor palms.'],
            ['name' => 'Croton', 'description' => 'A vibrant plant with multicolored leaves in red, orange, yellow, and green. Needs bright light.'],
            ['name' => 'Swiss Cheese Plant', 'description' => 'A climbing aroid with uniquely perforated leaves. Closely related to Monstera deliciosa.'],
            ['name' => 'Anthurium', 'description' => 'A tropical plant with glossy, heart-shaped red spathes. Blooms year-round indoors.'],
            ['name' => 'Alocasia Polly', 'description' => 'A striking plant with dark, arrow-shaped leaves and prominent white veins.'],
            ['name' => 'Hoya Carnosa', 'description' => 'A waxy-leaved trailing plant that produces clusters of fragrant, star-shaped flowers.'],
            ['name' => 'Dieffenbachia', 'description' => 'A lush tropical plant with large, patterned leaves. Grows quickly in bright indirect light.'],
            ['name' => 'Peperomia Obtusifolia', 'description' => 'A compact plant with thick, spoon-shaped leaves. Low maintenance and pet-friendly.'],
            ['name' => 'African Violet', 'description' => 'A classic flowering houseplant with velvety leaves and purple, pink, or white blooms.'],
            ['name' => 'Staghorn Fern', 'description' => 'An epiphytic fern with antler-shaped fronds. Typically mounted on boards or grown in baskets.'],
            ['name' => 'Bromeliad', 'description' => 'A tropical plant with a colorful central flower bract. Low maintenance and long-lasting blooms.'],
            ['name' => 'Begonia Rex', 'description' => 'A foliage begonia prized for its dramatic, multicolored spiral-patterned leaves.'],
            ['name' => 'Ponytail Palm', 'description' => 'A quirky succulent with a bulbous trunk and cascading, curly leaves. Very drought-tolerant.'],
            ['name' => 'Yucca', 'description' => 'A bold, architectural plant with sword-like leaves. Thrives in bright light with minimal water.'],
            ['name' => 'Schefflera', 'description' => 'An umbrella tree with glossy, palmate leaves. Can grow into a large indoor specimen.'],
            ['name' => 'Wandering Jew', 'description' => 'A fast-growing trailing plant with iridescent purple and silver striped leaves.'],
            ['name' => 'Norfolk Island Pine', 'description' => 'A tropical conifer with soft, layered branches. Often used as a living Christmas tree.'],
            ['name' => 'Oxalis Triangularis', 'description' => 'A bulb plant with deep purple, butterfly-shaped leaves that fold closed at night.'],
            ['name' => 'Maranta Red Prayer Plant', 'description' => 'A low-growing plant whose leaves fold upward at night like praying hands. Striking red veins.'],
            ['name' => 'Ctenanthe Burle-Marxii', 'description' => 'A prayer plant relative with oval leaves featuring a fishbone pattern in green and silver.'],
            ['name' => 'Stromanthe Triostar', 'description' => 'A colorful prayer plant with variegated pink, white, and green leaves with maroon undersides.'],
            ['name' => 'Aglaonema Silver Bay', 'description' => 'A Chinese evergreen with striking silver-green patterned leaves. Extremely low-maintenance.'],
            ['name' => 'Nerve Plant', 'description' => 'A small, spreading plant with intricately veined leaves in white, pink, or red on deep green.'],
            ['name' => 'Polka Dot Plant', 'description' => 'A cheerful plant covered in pink, red, or white spotted foliage. Compact and colorful.'],
            ['name' => 'Echeveria', 'description' => 'A rosette-forming succulent with plump, pastel-colored leaves. Perfect for sunny windowsills.'],
            ['name' => 'Haworthia', 'description' => 'A small succulent with translucent, striped leaves arranged in a tight rosette. Slow-growing.'],
            ['name' => 'Lithops', 'description' => 'Living stones — tiny succulents that mimic pebbles. Extremely drought-tolerant and unusual.'],
            ['name' => 'Burros Tail', 'description' => 'A trailing succulent with plump, overlapping blue-green leaves. Fragile but beautiful.'],
            ['name' => 'Christmas Cactus', 'description' => 'A forest cactus that blooms with tubular flowers in winter. Easy to grow and long-lived.'],
            ['name' => 'Crown of Thorns', 'description' => 'A succulent shrub with thick stems, sharp thorns, and bright red or pink flower bracts.'],
            ['name' => 'Kalanchoe', 'description' => 'A flowering succulent with clusters of small, vibrant blooms. Blooms last for weeks.'],
            ['name' => 'Senecio Rowleyanus Variegata', 'description' => 'A variegated string of pearls with green and cream striped beads. Rare and sought-after.'],
            ['name' => 'Tradescantia Nanouk', 'description' => 'A compact trailing plant with thick leaves in pink, green, and purple. Vibrant and fast-growing.'],
            ['name' => 'Philodendron Pink Princess', 'description' => 'A rare philodendron with dark green leaves splashed with bubblegum pink variegation.'],
            ['name' => 'Monstera Adansonii', 'description' => 'A trailing monstera with smaller, heavily fenestrated leaves. Fast climber with support.'],
            ['name' => 'Syngonium', 'description' => 'An arrowhead vine with soft, arrow-shaped leaves that change shape as the plant matures.'],
            ['name' => 'Scindapsus Pictus', 'description' => 'A satin pothos with velvety, dark green leaves speckled with silver. Elegant trailer.'],
            ['name' => 'Rhaphidophora Tetrasperma', 'description' => 'A mini monstera lookalike with small, split leaves. Fast-growing tropical climber.'],
            ['name' => 'Ficus Elastica Tineke', 'description' => 'A variegated rubber plant with cream, green, and pink-tinged leaves. Striking specimen plant.'],
            ['name' => 'Ficus Lyrata Bambino', 'description' => 'A dwarf fiddle leaf fig that stays compact. Same dramatic leaves in a smaller package.'],
            ['name' => 'Calathea Medallion', 'description' => 'A prayer plant with large, round leaves featuring dark and light green medallion patterns.'],
            ['name' => 'Calathea Rattlesnake', 'description' => 'A striking calathea with long, wavy-edged leaves marked with dark spots on light green.'],
            ['name' => 'Pilea Peperomioides', 'description' => 'The original Chinese money plant, beloved for its perfectly round, pancake-shaped leaves.'],
            ['name' => 'Asparagus Fern', 'description' => 'A feathery, cloud-like plant that is actually not a true fern. Vigorous grower.'],
            ['name' => 'Maidenhair Fern', 'description' => 'A delicate fern with fan-shaped leaflets on wiry black stems. Loves humidity and consistency.'],
            ['name' => 'Birds Nest Fern', 'description' => 'A rosette fern with wide, ripple-edged fronds. Epiphytic in nature, easy indoors.'],
            ['name' => 'Blue Star Fern', 'description' => 'A compact fern with wavy, blue-green fronds. More forgiving than most ferns.'],
            ['name' => 'Lemon Button Fern', 'description' => 'A small, rounded fern with tiny button-shaped leaves. Faintly lemon-scented when touched.'],
            ['name' => 'String of Hearts', 'description' => 'A dainty trailing plant with tiny, heart-shaped leaves on thread-like stems. Semi-succulent.'],
            ['name' => 'String of Turtles', 'description' => 'A miniature trailing peperomia with round leaves patterned like tiny turtle shells.'],
            ['name' => 'String of Dolphins', 'description' => 'A quirky succulent with leaves shaped like jumping dolphins. A senecio hybrid.'],
            ['name' => 'Tillandsia Ionantha', 'description' => 'A small air plant that blushes red before blooming purple flowers. No soil needed.'],
            ['name' => 'Tillandsia Xerographica', 'description' => 'A large, sculptural air plant with wide, silvery curling leaves. The king of air plants.'],
            ['name' => 'Venus Flytrap', 'description' => 'A carnivorous plant with snap-trap leaves that catch insects. Needs full sun and distilled water.'],
            ['name' => 'Pitcher Plant', 'description' => 'A carnivorous plant with tubular leaves that trap and digest insects. Striking and unusual.'],
            ['name' => 'Sundew', 'description' => 'A carnivorous plant with glistening, sticky tentacles that trap small insects.'],
            ['name' => 'Lavender', 'description' => 'An aromatic herb with purple flower spikes. Calming fragrance and loves full sun.'],
            ['name' => 'Rosemary', 'description' => 'A woody, fragrant herb with needle-like leaves. Dual purpose: culinary and ornamental.'],
            ['name' => 'Basil', 'description' => 'A fragrant culinary herb with soft green leaves. Thrives in warm, sunny spots.'],
            ['name' => 'Mint', 'description' => 'A vigorous aromatic herb with fresh, cool-flavored leaves. Grows quickly and spreads easily.'],
            ['name' => 'Oregano', 'description' => 'A hardy Mediterranean herb with small, pungent leaves. Essential in Italian and Greek cooking.'],
            ['name' => 'Thyme', 'description' => 'A low-growing herb with tiny aromatic leaves. Drought-tolerant and great for containers.'],
            ['name' => 'Cilantro', 'description' => 'A fast-growing herb with delicate, fan-shaped leaves. Bolts quickly in warm weather.'],
            ['name' => 'Lemongrass', 'description' => 'A tall, grassy herb with a strong citrus flavor. Used in Asian cuisine and teas.'],
            ['name' => 'Dracaena Fragrans', 'description' => 'A corn plant with broad, arching striped leaves. Hardy and tolerant of low light conditions.'],
            ['name' => 'Pachira Aquatica', 'description' => 'A money tree with a braided trunk and palmate leaves. Symbol of good fortune.'],
            ['name' => 'Spathiphyllum Sensation', 'description' => 'A giant peace lily with enormous ribbed leaves. Makes a bold statement in any room.'],
            ['name' => 'Zamioculcas Raven', 'description' => 'A ZZ plant variety with dramatic, near-black foliage. New leaves emerge bright green then darken.'],
            ['name' => 'Epipremnum Aureum Neon', 'description' => 'A neon pothos with vibrant chartreuse leaves. Brightens up dark corners effortlessly.'],
            ['name' => 'Peperomia Watermelon', 'description' => 'A compact plant with round leaves patterned like watermelon rinds. Adorable and easy.'],
            ['name' => 'Crassula Ovata Gollum', 'description' => 'A jade plant variety with tubular, finger-like leaves tipped in red. Whimsical and sculptural.'],
            ['name' => 'Euphorbia Trigona', 'description' => 'An African milk tree with tall, cactus-like stems and small leaves. Architectural and easy.'],
            ['name' => 'Sansevieria Moonshine', 'description' => 'A snake plant with pale, silvery-green leaves. Ethereal coloring and extremely low-maintenance.'],
            ['name' => 'Philodendron Birkin', 'description' => 'A compact philodendron with dark green leaves pinstriped in white. Slow-growing and elegant.'],
            ['name' => 'Philodendron Brasil', 'description' => 'A trailing philodendron with heart-shaped leaves striped in lime green and dark green.'],
            ['name' => 'Alocasia Zebrina', 'description' => 'An exotic alocasia with arrow-shaped leaves on striking zebra-striped stems.'],
            ['name' => 'Begonia Maculata', 'description' => 'An angel wing begonia with olive leaves covered in silver polka dots and red undersides.'],
            ['name' => 'Cyclamen', 'description' => 'A cool-season flowering plant with swept-back petals in pink, red, or white. Goes dormant in summer.'],
            ['name' => 'Orchid Phalaenopsis', 'description' => 'A moth orchid with long-lasting, elegant blooms. The most popular orchid for home growing.'],
            ['name' => 'Gardenia', 'description' => 'A fragrant flowering shrub with creamy white blooms and glossy dark leaves. Needs humidity.'],
            ['name' => 'Jasmine', 'description' => 'A climbing or trailing plant with intensely fragrant white star-shaped flowers.'],
        ];

        $user = User::first();

        foreach ($plants as $plant) {
            Plant::create(array_merge($plant, [
                'user_id' => $user->id,
            ]));
        }
    }
}
