import { Head } from '@inertiajs/react';

export default function Index({plants} : {plants: any[]}) {
    return (
        <>
            <Head title="Plants" />
            <h1 className="text-2xl font-bold">Plants</h1>
            <p className="mt-4">Welcome to the plants page! Here you can find information about your plants.</p>
            
            <ul className="mt-4 list-disc list-inside">
                {plants.map((plant) => (
                    <li key={plant.id}>{plant.name}</li>
                ))}
            </ul>
        </>
    );
}

