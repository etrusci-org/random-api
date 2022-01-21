import os
import datetime


TABLES = {
    # table: val type
    'data_names': 'string',
    'data_primes': 'number',
    'data_pseudohash16': 'string',
    'data_pseudohash32': 'string',
    'data_pseudohash64': 'string',
    'data_triangulars': 'number',
}


if __name__ == '__main__':
    try:
        THISDIR = os.path.abspath(os.path.dirname(__file__))

        for table in TABLES:
            SRCFILE = os.path.join(THISDIR, 'db', 'data', f'{table}.txt')
            OUTFILE = os.path.join(THISDIR, 'db', 'data', f'{table}.sql')

            with open(OUTFILE, 'w') as outFile:
                outFile.write(f'-- data for table: {table}\n')
                outFile.write(f'-- val type: {TABLES[table]}\n')
                outFile.write(f'-- created on: {datetime.datetime.utcnow()} UTC\n')
                outFile.write(f'-- src: {os.path.basename(SRCFILE)}\n')
                outFile.write(f'-- out: {os.path.basename(OUTFILE)}\n')
                outFile.write('BEGIN TRANSACTION;\n')

            with open(SRCFILE, 'r') as srcFile, open(OUTFILE, 'a') as outFile:
                for srcLine in srcFile:
                    val = srcLine.strip()

                    if (TABLES[table] == 'string'):
                        val = val.replace("'", "''")
                        val = f"'{val}'"

                    # if (TABLES[table] == 'number') {
                    # }

                    outFile.write(f'INSERT INTO {table} (val) VALUES ({val});\n')


                outFile.write('COMMIT;\n')


    except KeyboardInterrupt:
        print('\n')
