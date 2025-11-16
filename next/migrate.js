// migrate.js
const { Client } = require('pg');
const fs = require('fs');
const path = require('path');

// D1 (SQLite) SQL'ini PostgreSQL'e dönüştüren basit bir fonksiyon
function convertToPg(sqliteSql) {
    let pgSql = sqliteSql
        .replace(/INTEGER PRIMARY KEY AUTOINCREMENT/g, 'SERIAL PRIMARY KEY')
        .replace(/CREATE TABLE IF NOT EXISTS/g, 'CREATE TABLE IF NOT EXISTS')
        .replace(/CREATE INDEX IF NOT EXISTS/g, 'CREATE INDEX IF NOT EXISTS')
        .replace(/TEXT/g, 'TEXT')
        .replace(/INTEGER/g, 'INTEGER');

    // SQLite'a özgü ifadeleri kaldır
    pgSql = pgSql.replace(/-- D1 Uyumlu SQL Şeması/g, '-- PostgreSQL Uyumlu SQL Şeması');
    
    return pgSql;
}

async function main() {
    const connectionString = process.env.NEON_DATABASE_URL;
    if (!connectionString) {
        console.error('Hata: NEON_DATABASE_URL ortam değişkeni ayarlanmamış.');
        process.exit(1);
    }

    const client = new Client({
        connectionString: connectionString,
    });

    try {
        await client.connect();
        console.log('Neon veritabanına başarıyla bağlanıldı.');

        const sqlFilePath = path.join(__dirname, 'edevletaidat.sql');
        const sqliteSql = fs.readFileSync(sqlFilePath, 'utf8');
        
        const pgSql = convertToPg(sqliteSql);

        console.log('PostgreSQL\'e dönüştürülmüş SQL çalıştırılıyor...');
        
        // SQL komutlarını tek tek çalıştır
        const commands = pgSql.split(';').filter(cmd => cmd.trim() !== '');
        for (const command of commands) {
            await client.query(command);
        }

        console.log('Veritabanı şeması başarıyla Neon\'a eklendi.');

    } catch (err) {
        console.error('Veritabanı göçü sırasında hata oluştu:', err);
        process.exit(1);
    } finally {
        await client.end();
        console.log('Veritabanı bağlantısı kapatıldı.');
    }
}

main();
