import { Head, Link } from '@inertiajs/react';
import { index, show } from '@/routes/plants';
import { Card, CardContent } from '@/components/ui/card';

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
                        <Link key={plant.id} href={show.url(plant.id)}>
                            <Card className="gap-0 overflow-hidden py-0 transition-colors hover:border-primary/40 hover:bg-primary/5">
                                {plant.species?.thumbnail_url && (
                                    <img src={plant.species.thumbnail_url} alt={plant.name} className="h-32 w-full object-cover" />
                                )}
                                <CardContent className="p-4">
                                    <span className="font-medium">{plant.name}</span>
                                    {plant.species?.scientific_name?.[0] && (
                                        <p className="mt-1 text-xs italic text-muted-foreground">{plant.species.scientific_name[0]}</p>
                                    )}
                                </CardContent>
                            </Card>
                        </Link>
                    ))}
                </div>

                {plants.length === 0 && (
                    <p className="text-center text-sm text-muted-foreground">No plants yet. Add one above!</p>
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

