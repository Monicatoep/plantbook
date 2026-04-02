import { Head, useForm } from '@inertiajs/react';
import { index, store } from '@/routes/plants';

export default function Create() {
    const { data, setData, post, processing, errors, progress } = useForm({
        name: '',
        description: '',
        last_watered_at: '',
        image: null as File | null,
    });

    function submit(e: React.FormEvent<HTMLFormElement>) {
        e.preventDefault();
        post(store.url());
    }

    const inputClass = 'mt-1 w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:border-green-500 focus:ring-1 focus:ring-green-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500';

    return (
        <>
            <Head title="Add Plant" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">Add Plant</h1>
                    <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">Add a new plant to your collection.</p>
                </div>

                <form onSubmit={submit} className="flex max-w-md flex-col gap-4">
                    <div>
                        <label htmlFor="name" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input
                            id="name"
                            type="text"
                            value={data.name}
                            onChange={e => setData('name', e.target.value)}
                            placeholder="Plant name"
                            className={inputClass}
                        />
                        {errors.name && <p className="mt-1 text-xs text-red-500">{errors.name}</p>}
                    </div>

                    <div>
                        <label htmlFor="description" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                        <textarea
                            id="description"
                            value={data.description}
                            onChange={e => setData('description', e.target.value)}
                            rows={3}
                            placeholder="Describe your plant"
                            className={inputClass}
                        />
                        {errors.description && <p className="mt-1 text-xs text-red-500">{errors.description}</p>}
                    </div>

                    <div>
                        <label htmlFor="last_watered_at" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Watered</label>
                        <input
                            id="last_watered_at"
                            type="date"
                            value={data.last_watered_at}
                            onChange={e => setData('last_watered_at', e.target.value)}
                            className={inputClass}
                        />
                        {errors.last_watered_at && <p className="mt-1 text-xs text-red-500">{errors.last_watered_at}</p>}
                    </div>

                    <div>
                        <label htmlFor="image" className="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                        <input
                            id="image"
                            type="file"
                            accept="image/*"
                            onChange={e => setData('image', e.target.files?.[0] ?? null)}
                            className={inputClass}
                        />
                        {errors.image && <p className="mt-1 text-xs text-red-500">{errors.image}</p>}
                        {progress && (
                            <progress value={progress.percentage} max="100" className="mt-2 w-full">
                                {progress.percentage}%
                            </progress>
                        )}
                    </div>

                    <div>
                        <button
                            type="submit"
                            disabled={processing}
                            className="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 disabled:opacity-50"
                        >
                            Add Plant
                        </button>
                    </div>
                </form>
            </div>
        </>
    );
}

Create.layout = {
    breadcrumbs: [
        {
            title: 'Plants',
            href: index(),
        },
        {
            title: 'Add Plant',
            href: '#',
        },
    ],
};
