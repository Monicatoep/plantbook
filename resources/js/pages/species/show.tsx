import { Head, useForm } from '@inertiajs/react';
import { index } from '@/routes/species';
import { store } from '@/routes/plants';
import { useState } from 'react';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription, DialogFooter } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';

export default function Show({ species, alreadyAdded }: { species: any; alreadyAdded: boolean }) {
    const [open, setOpen] = useState(false);
    const { data, setData, post, processing, errors } = useForm({
        name: species.common_name,
        description: '',
        plant_species_id: species.id,
    });

    function addToMyPlants(e: React.FormEvent) {
        e.preventDefault();
        post(store.url(), {
            onSuccess: () => setOpen(false),
        });
    }
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

                <div>
                    {alreadyAdded ? (
                        <span className="inline-block rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                            Already in your plants
                        </span>
                    ) : (
                        <Button onClick={() => setOpen(true)} className="bg-green-600 hover:bg-green-700">
                            Add to My Plants
                        </Button>
                    )}
                </div>

                <Dialog open={open} onOpenChange={setOpen}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>Add to My Plants</DialogTitle>
                            <DialogDescription>Give your plant a name and optional description.</DialogDescription>
                        </DialogHeader>
                        <form onSubmit={addToMyPlants} className="flex flex-col gap-4">
                            <div className="flex flex-col gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input
                                    id="name"
                                    value={data.name}
                                    onChange={e => setData('name', e.target.value)}
                                    placeholder="Plant name"
                                />
                                {errors.name && <p className="text-xs text-red-500">{errors.name}</p>}
                            </div>
                            <div className="flex flex-col gap-2">
                                <Label htmlFor="description">Description</Label>
                                <textarea
                                    id="description"
                                    value={data.description}
                                    onChange={e => setData('description', e.target.value)}
                                    rows={3}
                                    placeholder="Describe your plant"
                                    className="border-input placeholder:text-muted-foreground flex w-full min-w-0 rounded-md border bg-transparent px-3 py-2 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                                />
                                {errors.description && <p className="text-xs text-red-500">{errors.description}</p>}
                            </div>
                            <DialogFooter>
                                <Button type="button" variant="outline" onClick={() => setOpen(false)}>Cancel</Button>
                                <Button type="submit" disabled={processing} className="bg-green-600 hover:bg-green-700">
                                    Add Plant
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
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
