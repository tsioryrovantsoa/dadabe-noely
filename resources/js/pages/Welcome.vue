<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { login, logout, register } from '@/routes';

const page = usePage();
</script>

<template>
    <main class="flex min-h-screen flex-col items-center justify-center gap-4">
        <Head title="Hello World" />

        <h1 class="text-4xl font-semibold">Hello World</h1>
        <p class="text-sm text-gray-500">Dadabe Noely</p>

        <div
            v-if="page.props.auth.child"
            class="flex flex-col items-center gap-2"
        >
            <p class="text-sm">
                Connecté avec {{ page.props.auth.child.email }} —
                <span class="font-semibold"
                    >{{ page.props.auth.child.bonus_points }} bons points</span
                >
            </p>
            <Link
                :href="logout()"
                method="post"
                as="button"
                class="text-sm text-red-700 underline"
                >Déconnexion</Link
            >
        </div>

        <div v-else class="flex gap-4 text-sm">
            <Link :href="login()" class="text-red-700 underline"
                >Connexion</Link
            >
            <Link :href="register()" class="text-red-700 underline"
                >Inscription</Link
            >
        </div>
    </main>
</template>
