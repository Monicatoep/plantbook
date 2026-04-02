import { Head, Link } from '@inertiajs/react';
import { index, show } from '@/routes/plants';

export default function Index({ plants }: { plants: any[] }) {
    return (
        <>
            <Head title="Plants" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">Plants</h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage your plant collection.</p>
                </div>

                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    {plants.map((plant) => (
                        <Link
                            key={plant.id}
                            href={show.url(plant.id)}
                            className="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-colors hover:border-green-300 hover:bg-green-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-green-700 dark:hover:bg-green-900/20"
                        >
                            {plant.image && (
                                <img src={plant.image} alt={plant.name} className="h-32 w-full object-cover" />
                            )}
                            <div className="p-4">
                                <span className="font-medium text-gray-900 dark:text-gray-100">{plant.name}</span>
                            </div>
                        </Link>
                    ))}
                </div>

                {plants.length === 0 && (
                    <p className="text-center text-sm text-gray-400 dark:text-gray-500">No plants yet. Add one above!</p>
                )}
            </div>
        </>
    );
}

Index.layout = {
    breadcrumbs: [
        {
            title: 'Plants',
            href: index(),
        },
    ],
};

