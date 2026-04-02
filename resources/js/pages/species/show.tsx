import { Head } from '@inertiajs/react';
import { index } from '@/routes/species';

export default function Show({ species }: { species: any }) {
    return (
        <>
            <Head title={species.common_name} />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                {species.image_url && (
                    <img src={species.image_url} alt={species.common_name} className="h-48 w-full rounded-xl object-cover sm:h-64" />
                )}
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">{species.common_name}</h1>
                    {species.scientific_name?.[0] && (
                        <p className="mt-1 text-sm italic text-gray-500 dark:text-gray-400">{species.scientific_name[0]}</p>
                    )}
                </div>

                <div className="grid max-w-md grid-cols-2 gap-4 text-sm">
                    {species.family && (
                        <div>
                            <span className="font-medium text-gray-700 dark:text-gray-300">Family</span>
                            <p className="text-gray-500 dark:text-gray-400">{species.family}</p>
                        </div>
                    )}
                    {species.genus && (
                        <div>
                            <span className="font-medium text-gray-700 dark:text-gray-300">Genus</span>
                            <p className="text-gray-500 dark:text-gray-400">{species.genus}</p>
                        </div>
                    )}
                    {species.cycle && (
                        <div>
                            <span className="font-medium text-gray-700 dark:text-gray-300">Cycle</span>
                            <p className="text-gray-500 dark:text-gray-400">{species.cycle}</p>
                        </div>
                    )}
                    {species.watering && (
                        <div>
                            <span className="font-medium text-gray-700 dark:text-gray-300">Watering</span>
                            <p className="text-gray-500 dark:text-gray-400">{species.watering}</p>
                        </div>
                    )}
                    {species.sunlight && (
                        <div>
                            <span className="font-medium text-gray-700 dark:text-gray-300">Sunlight</span>
                            <p className="text-gray-500 dark:text-gray-400">{species.sunlight}</p>
                        </div>
                    )}
                </div>

                {species.other_name?.length > 0 && (
                    <div className="text-sm">
                        <span className="font-medium text-gray-700 dark:text-gray-300">Also known as</span>
                        <p className="text-gray-500 dark:text-gray-400">{species.other_name.join(', ')}</p>
                    </div>
                )}
            </div>
        </>
    );
}

Show.layout = {
    breadcrumbs: [
        {
            title: 'Species',
            href: index(),
        },
        {
            title: 'Details',
            href: '#',
        },
    ],
};
