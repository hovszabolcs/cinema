import GuestLayout from "../layouts/GuestLayout.jsx";
import AuthenticatedLayout from "../layouts/AuthenticatedLayout.jsx";

export default function Index() {
    return (
        <AuthenticatedLayout>
            <h1>this is index page</h1>
        </AuthenticatedLayout>
    )
}
