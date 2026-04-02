import { Head, Link } from '@inertiajs/react';
import { index, show } from '@/routes/species';

interface PaginatedData<T> {
    data: T[];
    current_page: number;
    last_page: number;
    next_page_url: string | null;
    prev_page_url: string | null;
}

export default function Index({ species }: { species: PaginatedData<any> }) {
    return (
        <>
            <Head title="Species Catalog" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">Species Catalog</h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">Browse all plant species.</p>
                </div>

                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    {species.data.map((s) => (
                        <Link
                            key={s.id}
                            href={show.url(s.id)}
                            className="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-colors hover:border-green-300 hover:bg-green-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:border-green-700 dark:hover:bg-green-900/20"
                        >
                            {s.thumbnail_url && (
                                <img src={s.thumbnail_url} alt={s.common_name} className="h-32 w-full object-cover" />
                            )}
                            <div className="p-4">
                                <span className="font-medium text-gray-900 dark:text-gray-100">{s.common_name}</span>
                                {s.scientific_name?.[0] && (
                                    <p className="mt-1 text-xs italic text-gray-400 dark:text-gray-500">{s.scientific_name[0]}</p>
                                )}
                            </div>
                        </Link>
                    ))}
                </div>

                <div className="flex items-center justify-between">
                    {species.prev_page_url ? (
                        <Link href={species.prev_page_url} className="rounded-lg bg-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            Previous
                        </Link>
                    ) : <span />}
                    <span className="text-sm text-gray-500 dark:text-gray-400">
                        Page {species.current_page} of {species.last_page}
                    </span>
                    {species.next_page_url ? (
                        <Link href={species.next_page_url} className="rounded-lg bg-gray-200 px-4 py-2 text-sm text-gray-700 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                            Next
                        </Link>
                    ) : <span />}
                </div>
            </div>
        </>
    );
}

Index.layout = {
    breadcrumbs: [
        {
            title: 'Species',
            href: index(),
        },
    ],
};
