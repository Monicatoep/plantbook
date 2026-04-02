import { Head, Link } from '@inertiajs/react';
import { index, destroy } from '@/routes/plants';

export default function Show({ plant }: { plant: any }) {
    return (
        <>
            <Head title={plant.name} />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                {plant.image && (
                    <img src={plant.image} alt={plant.name} className="h-48 w-full rounded-xl object-cover sm:h-64" />
                )}
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">{plant.name}</h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        {plant.description || 'No description.'}
                    </p>
                </div>

                <div className="text-sm text-gray-600 dark:text-gray-400">
                    <span className="font-medium">Last watered:</span>{' '}
                    {plant.last_watered_at
                        ? new Date(plant.last_watered_at).toLocaleDateString()
                        : 'Never'}
                </div>

                <div>
                    <Link
                        href={destroy(plant.id)}
                        method="delete"
                        as="button"
                        className="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700"
                    >
                        Delete Plant
                    </Link>
                </div>
            </div>
        </>
    );
}

Show.layout = {
    breadcrumbs: [
        {
            title: 'Plants',
            href: index(),
        },
        {
            title: 'Details',
            href: '#',
        },
    ],
};
