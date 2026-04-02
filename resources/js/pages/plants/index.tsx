import { Head, Form, Link } from '@inertiajs/react';
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

                <Form action="/plants" method="post" resetOnSuccess className="flex items-start gap-2">
                    {({ errors, processing }) => (
                        <>
                            <div>
                                <input
                                    type="text"
                                    name="name"
                                    placeholder="Plant name"
                                    className="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500"
                                />
                                {errors.name && <p className="mt-1 text-xs text-red-500">{errors.name}</p>}
                            </div>
                            <button
                                type="submit"
                                disabled={processing}
                                className="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 disabled:opacity-50"
                            >
                                Add Plant
                            </button>
                        </>
                    )}
                </Form>

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

