import { Head, Link, useForm } from '@inertiajs/react';
import { index, show, store } from '@/routes/rooms';
import { Card, CardContent } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogDescription, DialogFooter } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useState } from 'react';
import { DoorOpen, Plus } from 'lucide-react';

export default function Index({ rooms }: { rooms: any[] }) {
    const [open, setOpen] = useState(false);
    const { data, setData, post, processing, errors, reset } = useForm({ name: '' });

    function handleSubmit(e: React.FormEvent) {
        e.preventDefault();
        post(store.url(), {
            onSuccess: () => {
                setOpen(false);
                reset();
            },
        });
    }

    return (
        <>
            <Head title="Rooms" />
            <div className="flex h-full flex-1 flex-col gap-6 p-4">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900 dark:text-gray-100">Rooms</h1>
                        <p className="mt-1 text-sm text-gray-500 dark:text-gray-400">Organize your plants by room.</p>
                    </div>
                    <Button onClick={() => setOpen(true)}>
                        <Plus className="mr-1 h-4 w-4" />
                        New Room
                    </Button>
                </div>

                <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    {rooms.map((room) => (
                        <Link key={room.id} href={show.url(room.id)}>
                            <Card className="gap-0 overflow-hidden py-0 transition-colors hover:border-primary/40 hover:bg-primary/5">
                                <CardContent className="flex items-center gap-3 p-4">
                                    <DoorOpen className="h-8 w-8 shrink-0 text-primary/60" />
                                    <div>
                                        <span className="font-medium">{room.name}</span>
                                        <p className="text-xs text-muted-foreground">
                                            {room.plants_count} {room.plants_count === 1 ? 'plant' : 'plants'}
                                        </p>
                                    </div>
                                </CardContent>
                            </Card>
                        </Link>
                    ))}
                </div>

                {rooms.length === 0 && (
                    <p className="text-center text-sm text-muted-foreground">No rooms yet. Create one to organize your plants!</p>
                )}

                <Dialog open={open} onOpenChange={setOpen}>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle>New Room</DialogTitle>
                            <DialogDescription>Give your room a name.</DialogDescription>
                        </DialogHeader>
                        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
                            <div className="flex flex-col gap-2">
                                <Label htmlFor="name">Name</Label>
                                <Input
                                    id="name"
                                    value={data.name}
                                    onChange={(e) => setData('name', e.target.value)}
                                    placeholder="e.g. Living Room"
                                />
                                {errors.name && <p className="text-xs text-red-500">{errors.name}</p>}
                            </div>
                            <DialogFooter>
                                <Button type="button" variant="outline" onClick={() => setOpen(false)}>
                                    Cancel
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    Create Room
                                </Button>
                            </DialogFooter>
                        </form>
                    </DialogContent>
                </Dialog>
            </div>
        </>
    );
}

Index.layout = {
    breadcrumbs: [
        {
            title: 'Rooms',
            href: index(),
        },
    ],
};
