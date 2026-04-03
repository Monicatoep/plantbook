import { Head, Link, router } from '@inertiajs/react';
import { Search, X } from 'lucide-react';
import { useRef, useState } from 'react';
import { Button } from '@/components/ui/button';
import { Card, CardContent } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { index, show } from '@/routes/species';

interface PaginatedData<T> {
    data: T[];
    current_page: number;
    last_page: number;
    next_page_url: string | null;
    prev_page_url: string | null;
}

export default function Index({
    species,
    filters,
}: {
    species: PaginatedData<any>;
    filters: { search: string };
}) {
    const [search, setSearch] = useState(filters.search);
    const timeoutRef = useRef<ReturnType<typeof setTimeout>>(null);

    function handleSearch(value: string) {
        setSearch(value);

        if (timeoutRef.current) {
            clearTimeout(timeoutRef.current);
        }

        timeoutRef.current = setTimeout(() => {
            router.get(
                index(),
                { search: value || undefined },
                { preserveState: true, replace: true },
            );
        }, 300);
    }

    function clearSearch() {
        handleSearch('');
    }

    return (
        <>
            <Head title="Species Catalog" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div>
                    <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">Species Catalog</h1>
                    <p className="mt-1 text-sm text-muted-foreground">Browse all plant species.</p>
                </div>

                <div className="relative max-w-sm">
                    <Search className="absolute left-3 top-1/2 size-4 -translate-y-1/2 text-muted-foreground" />
                    <Input
                        type="text"
                        placeholder="Search species..."
                        value={search}
                        onChange={(e) => handleSearch(e.target.value)}
                        className="pl-9 pr-9"
                    />
                    {search && (
                        <button
                            onClick={clearSearch}
                            className="absolute right-3 top-1/2 -translate-y-1/2 text-muted-foreground hover:text-foreground"
                        >
                            <X className="size-4" />
                        </button>
                    )}
                </div>

                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    {species.data.map((s) => (
                        <Link key={s.id} href={show.url(s.id)}>
                            <Card className="gap-0 overflow-hidden py-0 transition-colors hover:border-primary/40 hover:bg-primary/5">
                                {s.thumbnail_url && (
                                    <img src={s.thumbnail_url} alt={s.common_name} className="h-32 w-full object-cover" />
                                )}
                                <CardContent className="p-4">
                                    <span className="font-medium">{s.common_name}</span>
                                    {s.scientific_name?.[0] && (
                                        <p className="mt-1 text-xs italic text-muted-foreground">{s.scientific_name[0]}</p>
                                    )}
                                </CardContent>
                            </Card>
                        </Link>
                    ))}
                </div>

                {species.data.length === 0 && (
                    <p className="text-center text-sm text-muted-foreground">
                        No species found{search ? ` for "${search}"` : ''}.
                    </p>
                )}

                <div className="flex items-center justify-between">
                    {species.prev_page_url ? (
                        <Button variant="outline" asChild>
                            <Link href={species.prev_page_url}>Previous</Link>
                        </Button>
                    ) : <span />}
                    <span className="text-sm text-muted-foreground">
                        Page {species.current_page} of {species.last_page}
                    </span>
                    {species.next_page_url ? (
                        <Button variant="outline" asChild>
                            <Link href={species.next_page_url}>Next</Link>
                        </Button>
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
