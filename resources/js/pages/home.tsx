import { Head, Link, usePage } from '@inertiajs/react';
import { Leaf, Library, Plus } from 'lucide-react';
import { Card, CardContent } from '@/components/ui/card';
import { home } from '@/routes';
import { index as plantsIndex, show } from '@/routes/plants';
import { index as speciesIndex } from '@/routes/species';

type Plant = {
    id: number;
    name: string;
    species?: {
        thumbnail_url?: string;
        scientific_name?: string[];
    };
};

export default function Home({
    recentPlants,
    plantCount,
}: {
    recentPlants: Plant[];
    plantCount: number;
}) {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="Home" />
            <div className="flex h-full flex-1 flex-col gap-8 p-4 md:p-6">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        Welcome back, {auth.user?.name}
                    </h1>
                    <p className="mt-1 text-sm text-muted-foreground">
                        Here's an overview of your plant collection.
                    </p>
                </div>

                <div className="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <Link href={plantsIndex()}>
                        <Card className="transition-colors hover:border-primary/40 hover:bg-primary/5">
                            <CardContent className="flex items-center gap-4 p-5">
                                <div className="flex size-10 shrink-0 items-center justify-center rounded-lg bg-green-100 dark:bg-green-900/30">
                                    <Leaf className="size-5 text-green-600 dark:text-green-400" />
                                </div>
                                <div>
                                    <p className="text-2xl font-bold">{plantCount}</p>
                                    <p className="text-sm text-muted-foreground">
                                        {plantCount === 1 ? 'Plant' : 'Plants'} in your collection
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </Link>

                    <Link href={speciesIndex()}>
                        <Card className="transition-colors hover:border-primary/40 hover:bg-primary/5">
                            <CardContent className="flex items-center gap-4 p-5">
                                <div className="flex size-10 shrink-0 items-center justify-center rounded-lg bg-blue-100 dark:bg-blue-900/30">
                                    <Library className="size-5 text-blue-600 dark:text-blue-400" />
                                </div>
                                <div>
                                    <p className="text-sm font-medium">Species Catalog</p>
                                    <p className="text-sm text-muted-foreground">
                                        Browse and discover species
                                    </p>
                                </div>
                            </CardContent>
                        </Card>
                    </Link>
                </div>

                {recentPlants.length > 0 && (
                    <div>
                        <div className="mb-4 flex items-center justify-between">
                            <h2 className="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                Recent Plants
                            </h2>
                            <Link
                                href={plantsIndex()}
                                className="text-sm text-muted-foreground hover:text-foreground"
                            >
                                View all
                            </Link>
                        </div>
                        <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            {recentPlants.map((plant) => (
                                <Link key={plant.id} href={show.url(plant.id)}>
                                    <Card className="gap-0 overflow-hidden py-0 transition-colors hover:border-primary/40 hover:bg-primary/5">
                                        {plant.species?.thumbnail_url && (
                                            <img
                                                src={plant.species.thumbnail_url}
                                                alt={plant.name}
                                                className="h-32 w-full object-cover"
                                            />
                                        )}
                                        <CardContent className="p-4">
                                            <span className="font-medium">{plant.name}</span>
                                            {plant.species?.scientific_name?.[0] && (
                                                <p className="mt-1 text-xs italic text-muted-foreground">
                                                    {plant.species.scientific_name[0]}
                                                </p>
                                            )}
                                        </CardContent>
                                    </Card>
                                </Link>
                            ))}
                        </div>
                    </div>
                )}

                {recentPlants.length === 0 && (
                    <div className="flex flex-1 flex-col items-center justify-center gap-4 rounded-xl border border-dashed border-sidebar-border/70 p-12 text-center">
                        <div className="flex size-14 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                            <Leaf className="size-7 text-green-600 dark:text-green-400" />
                        </div>
                        <div>
                            <p className="font-medium text-gray-900 dark:text-gray-100">
                                No plants yet
                            </p>
                            <p className="mt-1 text-sm text-muted-foreground">
                                Start by browsing the species catalog and adding your first plant.
                            </p>
                        </div>
                        <Link
                            href={speciesIndex()}
                            className="mt-2 inline-flex items-center gap-2 rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90"
                        >
                            <Library className="size-4" />
                            Browse Species
                        </Link>
                    </div>
                )}
            </div>
        </>
    );
}

Home.layout = {
    breadcrumbs: [
        {
            title: 'Home',
            href: home(),
        },
    ],
};
